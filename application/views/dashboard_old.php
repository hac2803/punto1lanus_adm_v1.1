<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard <small>Panel de Control</small></h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row">

      <!-- Clientes -->
      <!-- <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $cantidadClientes; ?></h3>
            <p>Clientes</p>
          </div>
          <div class="icon">
            <i class="fa fa-child"></i>
          </div>
          <a href="<?php echo base_url(); ?>Mantenimiento/Cliente" class="small-box-footer">Ver Clientes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> -->

      <!-- Artículos -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $cantidadArticulos; ?></h3>
            <p>Artículos</p>
          </div>
          <div class="icon">
            <i class="fa fa-tags"></i>
          </div>
          <a href="<?php echo base_url(); ?>Mantenimiento/Articulo" class="small-box-footer">Ver Artículos <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> <!-- ./col -->

      <!-- Stock (Cantidad) -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
          <div class="inner">
            <h3><?php echo $cantidadStock; ?></h3>
            <p>Stock (Cantidad)</p>
          </div>
          <div class="icon">
            <i class="fa fa-barcode"></i>
          </div>
          <a href="<?php echo base_url(); ?>Consultas/Stock" class="small-box-footer">Ver Stock <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> <!-- ./col -->

      <!-- Stock (Costo) -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo "$ " . number_format($costoStock, 0, "", ","); ?></h3>
            <p>Stock (Costo)</p>
          </div>
          <div class="icon">
            <i class="fa fa-balance-scale"></i>
          </div>
          <a href="<?php echo base_url(); ?>Consultas/Stock" class="small-box-footer">Ver Stock <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> <!-- ./col -->

      <!-- Cuenta Corriente -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php echo "$ " . number_format($saldoVentas, 0, "", ","); ?></h3>
            <p>Cuenta Corriente</p>
          </div>
          <div class="icon">
            <i class="fa fa-book"></i>
          </div>
          <a href="<?php echo base_url(); ?>Movimientos/Ventas/deudores" class="small-box-footer">Ver Cuenta Corriente <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div> <!-- ./col -->

    </div> <!-- /.row -->

    <!-- Gráfico -->
    <?php
    // if ($rol_id == 1){
    $hidden = "";
    // }else{
    //   $hidden = " hidden";
    // }
    ?>
    <div class="row" <?= $hidden ?>>
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Estadísticas</h3>
            <div class="box-tools pull-right">
              <select name="years" id="year" class="form-control">
                <?php foreach ($years as $row) : ?>
                  <option value="<?php echo $row->year; ?>"><?php echo $row->year; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>


          <!-- Gráfico Ventas -->
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div id="graficoVentas" style="margin: 0 auto"></div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->


          <!-- Gráfico Valores -->
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div id="graficoValores" style="margin: 0 auto"></div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- ./box-body -->


        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<script>
  //////////////////////////////////////////////////////////////////////////////////////////
  $(document).ready(function() {
    //////////////////////////////////////////////////////////////////////////////////////////

    // Toma año actual
    var year = (new Date).getFullYear();

    // console.log(year);

    // Inicializa Highcharts
    Highcharts.setOptions({
      lang: {
        contextButtonTitle: 'Menú',
        printChart: 'Imprimir',
        downloadJPEG: 'Descargar JPG',
        downloadPDF: 'Descargar PDF',
        downloadPNG: 'Descargar PNG',
        noData: 'No hay datos para mostrar',
        decimalPoint: '.',
        thousandsSep: ','
      },
      exporting: {
        buttons: {
          contextButton: {
            // menuItems: ["printChart", "separator", "downloadPNG", "downloadJPEG", "downloadPDF"]
            menuItems: ["printChart", "downloadPNG", "downloadJPEG", "downloadPDF"]
          }
        }
      }
    });

    // Genera gráficos
    datagraficoVentas(base_url_js, year)
    datagraficoValores(base_url_js, year)

    // Regenera gráficos si cambia el año
    $("#year").on("change", function() {
      yearselect = $(this).val()
      datagraficoVentas(base_url_js, yearselect)
      datagraficoValores(base_url_js, yearselect)
    })

    function datagraficoVentas(base_url_js, year) {
      namesMonth = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"];

      // Ventas
      $.ajax({
        url: base_url_js + "dashboard/getDataVentas",
        type: "POST",
        data: {
          year: year
        },
        dataType: "json",
        success: function(data) {
          var meses = new Array();
          var montos = new Array();
          $.each(data, function(key, value) {
            meses.push(namesMonth[value.vec_mes - 1])
            valor = Number(value.vec_importe)
            montos.push(valor)
          })
          graficarVentas(meses, montos, year)
        }
      })
    }

    function datagraficoValores(base_url_js, year) {
      namesMonth = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"];

      // Valores
      $.ajax({
        url: base_url_js + "dashboard/getDataValores",
        type: "POST",
        data: {
          year: year
        },
        dataType: "json",
        success: function(data) {
          var meses = new Array();
          var montos = new Array();
          $.each(data, function(key, value) {
            meses.push(namesMonth[value.val_mes - 1])
            valor = Number(value.val_importe)
            montos.push(valor)
          })
          graficarValores(meses, montos, year)
        }
      })
    }

    function graficarVentas(meses, montos, year) {

      Highcharts.chart('graficoVentas', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Ventas por Mes'
        },
        subtitle: {
          text: 'Año ' + year
        },
        xAxis: {
          categories: meses,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: ' Monto Acumulado ($)'
          }
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">Monto:&nbsp </td>' + '<td style="padding:0"><b>$ {point.y:,.2f} </b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0
          },
          series: {
            dataLabel: {
              enable: true,
              formatter: function() {
                return Highcharts.numberFormat(this.y, 2)
              }
            }
          }
        },
        series: [{
          showInLegend: false,
          name: 'Meses',
          data: montos
        }],
      });
    }

    function graficarValores(meses, montos, year) {

      Highcharts.chart('graficoValores', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Valores por Mes'
        },
        subtitle: {
          text: 'Año ' + year
        },
        xAxis: {
          categories: meses,
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: ' Monto Acumulado ($)'
          }
        },
        tooltip: {
          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
          pointFormat: '<tr><td style="color:{series.color};padding:0">Monto:&nbsp </td>' + '<td style="padding:0"><b>$ {point.y:,.2f} </b></td></tr>',
          footerFormat: '</table>',
          shared: true,
          useHTML: true
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0
          },
          series: {
            dataLabel: {
              enable: true,
              formatter: function() {
                return Highcharts.numberFormat(this.y, 2)
              }
            }
          }
        },
        series: [{
          showInLegend: false,
          name: 'Meses',
          data: montos
        }],
      });
    }


    //////////////////////////////////////////////////////////////////////////////////////////
  }) // $(document).ready(function () {
  //////////////////////////////////////////////////////////////////////////////////////////
</script>