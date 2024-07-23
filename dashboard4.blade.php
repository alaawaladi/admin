@extends('layouts.user_type.auth2')

@section('content')


&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;



<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg " style="margin-bottom:20em">
   <div class="container-fluid py-4">
     <div class="row">
       <div class="col-12">
         <div class="card mb-4">
           <div class="card-header pb-0">
             <h1 style="font-size:30px">Operation de lutte contre l'émigration clandestine : bilan realisé par année</h1>
           </div>
           <div class="card-body px-0 pt-0 pb-2">
             <div class="table-responsive p-0">
              <fieldset class="border p-2">
                <legend  class="w-auto">    </legend><BR>
                   <form class="d-flex" action="{{route('bilan.annee')}}" method="GET">
                     <table align="center" >
                       <TR >
                        <TD >
                          <label>Type d'operation</label>
                               </TD>
                               <TD style="width: 500px;"><select id="operation" name="operation" class="form-control form-control-user" required>
                                <option >---Selectionner l'operation---</option>
                                <option value="Dispositif Permanent(6éme BSF/FAR-35éme GMM/FA-Marine Royale)">Dispositif Permanent(6éme BSF/FAR-35éme GMM/FA-Marine Royale)</option>
                                <option value="Dispositif de ratissage (AL/POLICE/GR/FA)">Dispositif de ratissage (AL/POLICE/GR/FA)</option>
                                

                             </TD>
                             <TD>
                                <label>Ville</label></TD> 
                                <TD style="width: 500px;"><select id="ville" name="ville" class="form-control form-control-user" required>
                                  <option >---Selectionner la ville---</option>
                                  <option value="mdiq">M'diq</option>
                                  <option value="fnideq">Fnideq</option>
                                  <option value="martil">Martil</option>
                                  <option value="bellyounech">Bellyounech</option>
                                  <option value="alliyenne">Alliyenne</option></select></TD> 
                                
                         
                      
                       </TR>
                       <tr>
                            <TD >
                            <label>Année</label>
                            </TD>
                            <TD style="width: 500px;">
                                <?php $years = range(1900, strftime("%Y", time())); ?>
                                
                                <select name="date" class="form-control form-control-user">
                                  <option>----</option>
                                  <?php foreach($years as $year) : ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                  <?php endforeach; ?>
                            </TD>
                       </tr>
                   
               <TR>
                 <TD colspan="6">
                   <div align="center"> <button class="btn btn-success" type="submit">chercher</button></div></TD>
               </TR>
                    </table>  
                   </form>
               </fieldset>

               
               
           </div>
           </div>
           </div>
           </div>
           </div>
           </div>
           </div>
           </div>
           </div>
           </div>
        </main>


@endsection
@push('dashboard')
  <script>
    window.onload = function() {
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                display: false
              },
            },
          },
        },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            },
            {
              label: "Websites",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
  </script>
@endpush




