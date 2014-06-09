function statHalfDonut(svgname, jsondata) {

   nv.addGraph(function() {

      var width = 400,
          height = 400;

      var chart = nv.models.pieChart()
          .x(function(d) { return d.key })
          .values(function(d) { return d.value })
          .showLabels(false)
          .color(function(d) {return d.data.color})
          .width(width)
          .height(height)
          .donut(true);

      chart.pie
          .startAngle(function(d) { return d.startAngle/2 -Math.PI/2 })
          .endAngle(function(d) { return d.endAngle/2 -Math.PI/2 });

      d3.select('#' + svgname)
          .datum(JSON.parse(jsondata))
          .transition().duration(1200)
          .attr('width', width)
          .attr('height', height)
          .call(chart);

      return chart;
   });
}


function statBar(svgname, jsondata, title, width) {
   
   nv.addGraph(function() {

      var height = 250;
          
      var chart = nv.models.discreteBarChart()
          .x(function(d) { return d.label })
          .y(function(d) { return d.value })
          .width(width)
          .height(height)
          .staggerLabels(false)
          .tooltips(false)
          .showValues(false)
          .color(['#76e1e5']);

      chart.yAxis
        .tickFormat(d3.format(',.0d'));
      
      d3.select('#' + svgname)
         .datum([JSON.parse(jsondata)])
         .call(chart);

      d3.select('#' + svgname)
         .append('text')
         .attr('x', 200)
         .attr('y', 12)
         .attr('text-anchor', 'middle')
         .style('font-weight', 'bold')
         .text(title);

      nv.utils.windowResize(chart.update);
      
      return chart;
   });
}


function statChartProgressArc(svgname, color) {
   $(document).ready(function(){
      var $pc = $('#progressController' + svgname);
      var $pCaption = $('#progress-bar-p' + svgname);
      var iProgress = document.getElementById('inactiveProgress' + svgname);
      var aProgress = document.getElementById('activeProgress' + svgname);
      var iProgressCTX = iProgress.getContext('2d');


      drawInactive(iProgressCTX);

      $pc.on('change', function(){
         var percentage = $(this).val() / 100;
         drawProgress(aProgress, percentage, $pCaption);
      });

      function drawInactive(iProgressCTX){
         iProgressCTX.lineCap = 'square';

         //outer ring
         iProgressCTX.beginPath();
         iProgressCTX.lineWidth = 15;
         iProgressCTX.strokeStyle = '#e1e1e1';
         iProgressCTX.arc(90,90,70,0,2*Math.PI);
         iProgressCTX.stroke();

         //progress bar
         iProgressCTX.beginPath();
         iProgressCTX.lineWidth = 0;
         iProgressCTX.fillStyle = '#e6e6e6';
         iProgressCTX.arc(90,90,62,0,2*Math.PI);
         iProgressCTX.fill();

         //progressbar caption
         iProgressCTX.beginPath();
         iProgressCTX.lineWidth = 0;
         iProgressCTX.fillStyle = '#fff';
         iProgressCTX.arc(90,90,50,0,2*Math.PI);
         iProgressCTX.fill();

      }
      function drawProgress(bar, percentage, $pCaption){
         var barCTX = bar.getContext("2d");
         var quarterTurn = Math.PI / 2;
         var endingAngle = ((2*percentage) * Math.PI) - quarterTurn;
         var startingAngle = 0 - quarterTurn;

         bar.width = bar.width;
         barCTX.lineCap = 'square';

         barCTX.beginPath();
         barCTX.lineWidth = 12;
         barCTX.strokeStyle = '#' + color;
         barCTX.arc(90,90,56,startingAngle, endingAngle);
         barCTX.stroke();

         $pCaption.text( (parseInt(percentage * 100, 10)) + '%');
      }
      
      var percentage = $pc.val() / 100;
      drawProgress(aProgress, percentage, $pCaption);
   });
}
   