    // Configuración de Firebase
    const firebaseConfig = {
        apiKey: "AIzaSyBBG-spv7t09SKNSiwE3PAVNfWQ1Szlu7M",
        authDomain: "login-app-142b7.firebaseapp.com",
        projectId: "login-app-142b7",
        storageBucket: "login-app-142b7.appspot.com",
        messagingSenderId: "465765324483",
        appId: "1:465765324483:web:02f48f9f5cc686c0493476",
        measurementId: "G-1BB3SL56K9"
    };

    // Inicializar Firebase
    const firebaseApp = firebase.initializeApp(firebaseConfig);

    
    var app = angular.module("myApp", ["ngRoute"]);

    
    app.run(['$rootScope', function($rootScope) {
        $rootScope.$on('$routeChangeSuccess', function(event, current) {
            if (current.$$route) {
                $rootScope.title = current.$$route.title;
            }
        });
    }]);

    app.config(function($routeProvider) {
        $routeProvider
        .when('/', {
            templateUrl: 'main.html',
            controller: 'MainController',
            title: 'Inicio'
        })
        .when('/contacto', {
            templateUrl: 'contacto.html',
            controller: 'ContactoController',
            title: 'Contacto'
        })
        .when('/consultar', {
            templateUrl: 'consultar.html',
            controller: 'ConsultarController',
            title: 'Consultar',
            requireAuth: true
        })
        .when('/resumen', {
            templateUrl: 'resumen.html',
            controller: 'ResumenController',
            title: 'Resumen',
            requireAuth: true
        })
        .when('/grafico', {
            templateUrl: 'grafico.html',
            controller: 'GraficoController',
            title: 'Gráfico',
            requireAuth: true
        })
        .when('/login', {
            templateUrl: 'login.html',
            controller: 'LoginController',
            title: 'Iniciar Sesión'
        })
        .otherwise({
            redirectTo: '/'
        });
    });

    app.controller('HeaderController', function($scope) {
        $scope.user = null;
      
        firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
            // El usuario ha iniciado sesión
            $scope.user = user;
          } else {
            // El usuario no ha iniciado sesión
            $scope.user = null;
          }
          $scope.$apply();
        });

        $scope.signOut = function() {
            firebase.auth().signOut();
          };
    });

    app.controller('MainController', function($scope) {
        
    });

    app.controller('ContactoController', function($scope) {

    });

    app.controller('ConsultarController', function($scope, $http, $interval) {
        $scope.casos = [];
        $scope.error = null;
    
        function obtenerCasos() {
            $http.get("http://localhost:8080/casos")
                .then(function(response) {
                    $scope.casos = response.data;
                    $scope.error = null;
                })
                .catch(function(error) {
                    console.error(error);
                    $scope.error = "No se han podido obtener los casos o no hay casos disponibles en este momento.";
                });
        }
    
        // Obtener los casos iniciales
        obtenerCasos();
    
        // Actualizar los casos cada 5 segundos
        $interval(obtenerCasos, 5000);
    });

    app.controller('ResumenController', function($scope, $http) {
        const url = "http://localhost:8080/resumen";
        $http.get(url).then(function(response) {
            const resumenes = response.data;
            const resumenesDiv = document.getElementById("resumenes");
            resumenes.forEach(resumen => {
                const card = document.createElement("div");
                card.className = "card my-4 bg-muted";
                card.innerHTML = `
                <div class="card-body">
                    <h2 class="card-title text-left" style="font-size: 1.5rem;">${resumen.fecha}</h2>
                    <p class="card-text text-muted" style="font-size: 1.2rem;">${resumen.resumen}</p>
                </div>`;
                resumenesDiv.appendChild(card);
            });
        });
    });
    app.controller('GraficoController', function($scope, $http) {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    
        function drawChart() {
            $http.get('http://localhost:8080/datos').then(function(response) {
                const datos = response.data;
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
    });


    app.controller('LoginController', function($scope,$location) {
            const provider = new firebase.auth.GoogleAuthProvider();
        
            $scope.signInWithGoogle = function() {
                firebase.auth()
                    .signInWithPopup(provider)
                    .then((result) => {
                        // Obtener información del perfil del usuario
                        const credential = result.credential;
                        const token = credential.accessToken;
                        const user = result.user;
                        console.log(user);
                        $location.path('/');
                    }).catch((error) => {
                        // Manejar errores aquí
                        const errorCode = error.code;
                        const errorMessage = error.message;
                        const email = error.email;
                        const credential = error.credential;
                    });
            }
    });
    
    app.config(function($routeProvider, $locationProvider) {
        $locationProvider.hashPrefix('');

    });

    app.run(function($rootScope, $location) {
        $rootScope.$on('$routeChangeStart', function(event, next, current) {
          if (next.requireAuth && !firebase.auth().currentUser) {
            $location.path('/login');
          }
        });
      });
