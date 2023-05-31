describe('drawChart', function() {
    beforeEach(function() {
      // Configurar el entorno necesario para la prueba, si es necesario.
    });
  
    it('debería llamar a la función de dibujo del gráfico', function(done) {
      spyOn(google.charts, 'setOnLoadCallback').and.callFake(function(callback) {
        callback();
      });
  
      spyOn(google.visualization, 'LineChart').and.callFake(function(element) {
        return {
          draw: function(data, options) {
            // Verificar que los parámetros data y options sean correctos
            expect(data instanceof google.visualization.DataTable).toBe(true);
            expect(options.title).toBe('Casos confirmados y fallecimientos por provincia a día de hoy');
            // Agrega más expectativas según sea necesario para verificar el dibujo del gráfico
            done();
          }
        };
      });
  
      // Llamar a la función que deseas probar
      drawChart();
    });
  });
  