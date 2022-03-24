
<html>
    <head>
        <title>PT RSB Monitoring</title>
        <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.4/firebase-analytics.js"></script>
<!-- <script src="chartjs/Chart.bundle.js"></script>
        <style type="text/css">
            .container {
                width: 100%;
                margin: 190px auto auto auto;
            }
        </style> -->
<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
//   var firebaseConfig = {
//     apiKey: "AIzaSyDT2hTOobjTPdKnTlV2__oeHyt5y3nuJ0o",
//     authDomain: "monitoring-5c5e5.firebaseapp.com",
//     projectId: "monitoring-5c5e5",
//     storageBucket: "monitoring-5c5e5.appspot.com",
//     messagingSenderId: "328422137006",
//     appId: "1:328422137006:web:6459bccde2a8fd94f7e13f",
//     measurementId: "G-4GZKDBP93J"
//   };
var firebaseConfig = {
    apiKey: "AIzaSyAuBBM2b4YhZ36yIszORj_NVdR89SnVhss",
    authDomain: "monitoring-4386b.firebaseapp.com",
    projectId: "monitoring-4386b",
    storageBucket: "monitoring-4386b.appspot.com",
    messagingSenderId: "200222063834",
    appId: "1:200222063834:web:d9d6954fd334d24a21f9e3",
    measurementId: "G-KV5S1RKLNJ"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  // firebase.analytics();
  console.log(firebase);

  var database = firebase.database();
  var ref = database.ref('sensor');



function getdata(callback){
  ref.on('value',function(snapshot){
    snapshot.forEach(function(data){
      var sensors = data;
      callback(sensors);
    })
  });
}

var namespH =[];
var valuespH =[];
var counterpH = 0;
var currentdate = new Date(); 
// var datetime = " : " + currentdate.getDate() + "/"
//                 + (currentdate.getMonth()+1)  + "/" 
//                 + currentdate.getFullYear() + " @ "  
//                 + currentdate.getHours() + ":"  
//                 + currentdate.getMinutes() + ":" 
//                 + currentdate.getSeconds();

getdata(function(sensors){

    if(sensors.val().name == "pH"){
    namespH.push(sensors.val().name + counterpH);
    valuespH.push(sensors.val().value);
    loadChartpH();
    counterpH += 1;
    }

});

  function errData(err){
    console.log(err)
  }
  function pushData(dname, dvalue){
    data = {
      name : dname,
      value : dvalue
    }
    database.ref('sensor').push(data);
  }
</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js"></script>
       
        <style type="text/css">
            .container {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <canvas id="mypH"></canvas>
       
        <script>

          function loadChartpH(){
            var ctx = document.getElementById("mypH").getContext('2d');

            var dnamespH;
            var lnamespH = namespH.length;
            if(lnamespH > 10){
                dnamespH = [namespH[lnamespH-10], namespH[lnamespH-9], namespH[lnamespH-8], namespH[lnamespH-7], namespH[lnamespH-6], namespH[lnamespH-5], namespH[lnamespH-4], namespH[lnamespH-3], namespH[lnamespH-2], namespH[lnamespH-1]];
            }
            else dnamespH = namespH;

            var dvaluespH;
            var lvaluespH = valuespH.length;
            if(lvaluespH > 10){
                dvaluespH = [valuespH[lvaluespH-10], valuespH[lvaluespH-9], valuespH[lvaluespH-8], valuespH[lvaluespH-7], valuespH[lvaluespH-6], valuespH[lvaluespH-5], valuespH[lvaluespH-4], valuespH[lvaluespH-3], valuespH[lvaluespH-2], valuespH[lvaluespH-1]];
            }
            else dvaluespH = valuespH;

            
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dnamespH,
                    datasets: [{
                            label: 'pH Sensor : ' + valuespH[lvaluespH-1] + ' (Last Data)',
                            data: dvaluespH,
                            backgroundColor: [
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)',
                                'rgba(255, 99, 132, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(255, 216, 89, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)',
                                'rgba(255, 99, 132, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
          }
        
        </script>
        
    </body>
</html>