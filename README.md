## Diseño de patrones en Laravel

Ejemplo de aplicación de los distintos patrones de diseño en el Framework Laravel v10.0

### Abstract Factory
#### 
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
