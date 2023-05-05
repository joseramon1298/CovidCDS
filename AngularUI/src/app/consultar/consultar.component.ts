import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-consultar',
  templateUrl: './consultar.component.html',
  styleUrls: ['./consultar.component.css']
})
export class ConsultarComponent implements OnInit {
  casos: any[] = [];
  error: boolean = false;
  url = "http://localhost:8080/casos";

  constructor(private titleService: Title) { }

  ngOnInit(): void {
    this.titleService.setTitle('Consultar - CovidCDS');
    this.obtenerCasos();
    setInterval(() => this.obtenerCasos(), 5000);
  }

  obtenerCasos() {
    fetch(this.url)
      .then(response => response.json())
      .then(casos => {
        this.casos = casos;
        this.error = false;
      })
      .catch(error => {
        this.error = true;
        console.error(error);
      });
  }
}
