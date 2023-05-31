import { JSDOM } from 'jsdom';
import fetch from 'node-fetch';
import { obtenerCasos, inicializar } from '../javascript/consultar.js';

const dom = new JSDOM('<!DOCTYPE html><html><body><table id="casos-table"></table></body></html>');
const { window } = dom;
global.window = window;
const document = dom.window.document;
global.document = document;
global.fetch = fetch;
window.fetch = fetch;

inicializar();

describe('obtenerCasos', () => {
  it('debería actualizar la tabla HTML con los datos de los casos de COVID', async () => {
    // Simular la respuesta del servidor
    let casosSimulados = [
      { fecha: '2022-01-01', provincia: 'Madrid', casos_confirmados: 100, nuevos_positivos: 10, altas: 5, fallecimientos: 2 },
      { fecha: '2022-01-02', provincia: 'Barcelona', casos_confirmados: 200, nuevos_positivos: 20, altas: 10, fallecimientos: 4 }
    ];

    spyOn(window, 'fetch').and.returnValue(Promise.resolve({
      json: () => Promise.resolve(casosSimulados)
    }));

    // Llamar a la función obtenerCasos
    await obtenerCasos();

    // Verificar que la tabla HTML se actualiza correctamente
    let tablaCasos = document.getElementById('casos-table');
    expect(tablaCasos.rows.length).toEqual(3);
    expect(tablaCasos.rows[1].cells[0].innerText).toEqual('2022-01-01');
    expect(tablaCasos.rows[1].cells[1].innerText).toEqual('Madrid');
    expect(tablaCasos.rows[1].cells[2].innerText).toEqual('100');
    expect(tablaCasos.rows[1].cells[3].innerText).toEqual('10');
    expect(tablaCasos.rows[1].cells[4].innerText).toEqual('5');
    expect(tablaCasos.rows[1].cells[5].innerText).toEqual('2');
    expect(tablaCasos.rows[2].cells[0].innerText).toEqual('2022-01-02');
    expect(tablaCasos.rows[2].cells[1].innerText).toEqual('Barcelona');
    expect(tablaCasos.rows[2].cells[2].innerText).toEqual('200');
    expect(tablaCasos.rows[2].cells[3].innerText).toEqual('20');
    expect(tablaCasos.rows[2].cells[4].innerText).toEqual('10');
    expect(tablaCasos.rows[2].cells[5].innerText).toEqual('4');
  });
});
