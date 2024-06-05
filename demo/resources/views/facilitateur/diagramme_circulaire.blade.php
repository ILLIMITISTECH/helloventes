<!DOCTYPE html>
<html>
<head>
<title>Diagramme circulaire</title>
<meta charset="UTF-8">
</head>
<body>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
// Chart 1
var data = google.visualization.arrayToDataTable([['OS Mobile', 'Parts de marché'],["Leadership",{{$competence_1}}],["Management",{{$competence_2}},["Confiance en soi",{{$competence_3}}],["Délégation",{{$competence_4}}],["Écoute active",{{$competence_5}}],["Gestion de conflits",{{$competence_6}}],["Techniques de Vente et négociation",{{$competence_7}}],["Prise de parole en public",{{$competence_8}}],["Travail en équipe",{{$competence_9}}],["Intelligence émotionnelle",{{$competence_10}}],["Focus et productivité",{{$competence_11}}],["Orientation resultat",{{$competence_12}}]]);
var options = {
title: 'Parts de marché des OS Mobile en Juin 2014 (France)'
};
var chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(data, options);
}
</script>
<div id="piechart" style="width: 100%; height: 500px;">&nbsp;</div>
</body>
</html>