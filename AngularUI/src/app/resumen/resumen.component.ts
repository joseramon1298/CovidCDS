import { Component, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-resumen',
  templateUrl: './resumen.component.html',
  styleUrls: ['./resumen.component.css']
})
export class ResumenComponent implements OnInit {
  resumenes: any[] = [];

  constructor(private titleService: Title) { }

  ngOnInit(): void {
    this.titleService.setTitle('Resumen - CovidCDS');
    const url = "http://localhost:8080/resumen"
    fetch(url)
      .then(response => response.json())
      .then(resumenes => {
        this.resumenes = resumenes;
      });
  }
}
