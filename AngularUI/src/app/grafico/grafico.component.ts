import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';

declare var google: any;

@Component({
  selector: 'app-grafico',
  templateUrl: './grafico.component.html',
  styleUrls: ['./grafico.component.css']
})
export class GraficoComponent implements OnInit {
  constructor(private titleService: Title) { }

  ngOnInit(): void {
    this.titleService.setTitle('Gráfico - CovidCDS');
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(this.drawChart.bind(this));
  }

  drawChart() {
    fetch('http://localhost:8080/datos')
      .then(response => response.json())
      .then(datos => {
        const data = new google.visualization.DataTable();
        data.addColumn('string', 'Provincia');
        data.addColumn('number', 'Casos confirmados');
        data.addColumn('number', 'Fallecimientos');
        for (const dato of datos) {
          data.addRow([dato.provincia, dato.casos_confirmados, dato.fallecimientos]);
        }

        const options = {
          title: 'Casos confirmados y fallecimientos por provincia a día de hoy',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      });
  }
}
