## Diseño de patrones en Laravel

Ejemplo de aplicación de los distintos patrones de diseño en el Framework Laravel v10.0

### Creational :: Abstract Factory

El patrón Abstract Factory es un patrón de diseño creacional que proporciona una interfaz para crear familias de objetos relacionados o dependientes sin especificar sus clases concretas. Le permite crear objetos en función de determinadas condiciones o requisitos, lo que la convierte en una solución versátil para gestionar la creación de objetos.

#### Casos de Uso
- Implementar elementos gráficos (botones, ventanas, menús) que deban verse igual en distintos sistemas operativos
- Soporte de diferentes bases de datos, accediendo a ellas a través de una interfaz e implementando como convenga cada una de ellas
- Poder exportar un documento a distintos formatos (PDF, XML, JSON, etc)
- Soporte de diferentes tipos de caché
- Soporte de diferentes tipos de Storage
- Soporte de diferentes tipos de autenticación
- Soporte de diferentes tipos de pago...
- etc

#### Implementación
Supongamos que tenemos que implementar un nuevo tipo de pago. Hasta el momento sólo tenemos funcionando la pasarela de Redsys, pero ahora hay que añadir la opción de poder pagar con PayPal.

Una primera idea sería hacer, dentro de algún controlador:

```
if ($paymentMode === 'redsys') {
    // llamar a la función de pago por Redsys
} elseif ($paymentMode === 'paypal') {
    // llamar a la función de pago por PayPal
} else {
    // pago no soportado
}
```

Si tuviésemos que añadir nuevos métodos de pago, el código crecería y no sería muy escalable, aparte que tampoco cumpliría con los principios de abierto/cerrado ni el de responsabilidad única.

La solución es la siguiente:

- creamos una interfaz base que sea `PaymentGatewayFactory`
- creamos tantos Factories concretos como tipos de pago tengamos:
  - `PaypalPaymentGatewayFactory`
  - `RedsysPaymenteGatewayFactory`
- creamos una interfaz base para la acción de pago que queremos hacer `PaymentGateway`
- y una implementación de la anterior interfaz por cada tipo de pago disponible (`PaypalPaymentGateway` y `RedsysPaymentGateway`)
- generamos un `PaymentServiceProvider` que ponga en marcha el tipo adecuado de pago según la configuración o el parámetro que le pasemos.

------


### Creational :: Singleton

El patrón Singleton nos asegura una única instancia de un objeto, creando un único punto de entrada al mismo. Aunque pueda parecer una ventaja, hay que utilizarla con cuidado para evitar la rotura de modularidad del código.

#### Casos de Uso
- Acceso a base de datos mediante una única conexión activa
- Carga de configuración de la aplicación mediante un único método
- Registro de Logs, donde una sola clase se encarga de escribir en el Storage los mensajes correspondientes
- Sistema único de render, dado que muchas veces, el objeto encargado de parsear plantillas es costoso, nos aseguraríamos que sólo existiese una instancia en memoria
- etc

#### Implementación
Supongamos que tenemos que crear un sistema de registro de Logs. Como el registro de Logs se realiza en multitud de puntos de la aplicación, no nos conviene que, en cada punto, se cree un nuevo objeto de escritura de Logs, por lo que decidimos que sea de tipo `Singleton`

Creamos una clase Logger con una propiedad protegida `instance` que contenga la instancia única de dicha clase e implementamos el método `register` que comprobará si ya hay una instancia creada o, en caso contrario, se encarga de crear una nueva instancia.

```
protected static self|null $instance = null;
```

```
public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return static::$instance;
    }
```

#### Uso
```
$firstLogger = LoggerSingleton::getInstance(); // Creating first singleton instance
$secondLogger = LoggerSingleton::getInstance(); // Trying create second singleton instance

// $firstLogger && $secondLogger should be the same object!
```

------

### Creacional :: Builder

Separa la construcción de un objeto complejo de su representación, de modo que el mismo proceso de construcción puede crear diferentes representaciones. Este patrón es especialmente útil cuando un objeto debe ser creado con muchas opciones posibles y configuraciones.

#### Casos de Uso
- Creación de objetos con múltiples opciones posibles de configuración.
- Objetos que, para su definición, necesiten usar métodos de encadenamiento.
- Crear documentos con estructura de bloques (tipo HTML, XML, etc...).
- Crear menús de comida con personalización del plato (con/sin ingredientes concretos).
- Configuración de objetos de tipo informático (el resultado del producto depende de múltiples valores de cada tipo de componente).

#### Implementación
Vamos a crear un objeto de tipo `Coche` en el que, para su definición, hay que indicar la marca, el modelo y el color.

Empezamos creando una interfaz `CarBuilderInterface` que define las acciones sobre el objeto, esto es: setear marca, modelo y color. Y añadimos también un método `getCar` para obtener la información completa del coche.

Creamos una clase `CarBuilder` que implemente dicha interfaz. En los métodos setters `setBrand`, `setModel` y `setColor` retornará el propio objeto que se está definiendo, para que podamos encadenar el uso de estos métodos.

Para usar este patrón, haremos algo parecido a lo siguiente:

```
$carBuilder = new CarBuilder();
$europeanCar = $carBuilder->setBrand('Peugeot')->setModel('508')->setColor('White');
$americanCar = $carBuilder->setBrand('Chevrolet')->setModel('Camaro')->setColor('Grey');
```


### Creacional :: Factory

```NO confundir con el Abstract Factory Pattern.```
Este patrón nos ayuda en la creación de objetos de la misma familia cuyos valores internos son diferentes mediante la definición de una interfaz. Desacopla la lógica de creación de la lógica de negocio, evitando al cliente conocer detalles de la instanciación de los objetos de los que depende.

#### Casos de uso
- Gestión documental: ayuda en la creación de distintos tipos de documentos (PDF, XML, DOC,...). Cada tipo puede necesitar componerse de una manera distinta, así como a la hora de visualzarse.
- Interfaces de usuario (Themes), donde cada elemento puede construirse y visualizarse de diferente manera según el SO en el que vaya a operar.
- Conexión universal a base de datos: da igual la base de datos utilizada, se usan los mismos métodos definidos en la interfaz para acceder a cualquier de ellas.
- Conexión entre servicios: podemos gestionar de la misma manera accesos a terceras partes de otra aplicación sin preocuparnos cómo se conectan por debajo.

#### Implementación
Para la creación de objetos según un valor dado, podríamos pensar en una estructura `switch/if` que, dependiendo del valor de entrada, instanciaba uno u otro objeto.

```
switch ($model) {
    case "car":
        $wheels = 4;
        $brand = "Mercedes";
        $modelObject = new Car($wheels, $brand);
        break;
    case "bike":
        $wheels = 2;
        $brand = "Kawasaki";
        $modelObject = new Bike($wheels, $brand);
        break;
}
return $modelObject;
```

Si queremos añadir nuevas variantes, deberíamos modificar el controlador, que no tiene porqué saber cómo debe instanciarse por debajo cada tipo de objeto y, además, rompe los principios de responsabilidad única y el de abierto/cerrado.

Para solucionar este problema de diseño, crearemos una interfaz que sea común a todos los objetos y que éstos deberán implementar. Añadiremos un `VehicleFactory` que se encargue de crear el objeto del tipo que corresponda, y luego implementaremos las distintas clases que hagan falta.

El controlador, quedaría simplificado de la siguiente manera:

``` 
class Vehicle
{
    private $vehicleFactory;
    public function __construct(VehicleFactory $vehicleFactory);
    {
        $this->vehicleFactory = $vehicleFactory;
    }
    public function getVehicleInfo(string $vehicleType)
    {
        $vehicle = $this->vehicleFactory->create($vehicleType);
        $output = 'El vehículo de tipo %s, tiene %s ruedas y es de la marca %s' . PHP_EOL;
        return sprintf(
            $output,
            $vehicleType,
            $vehicle->getWheels(),
            $vehicle->getBrand()
        );       
    }
}
```
