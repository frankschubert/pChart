<?php

/*
  Example8 : A radar graph
 */

// Standard inclusions   
require_once("../lib/pData.php");
require_once("../lib/pChart.php");
require_once '../lib/GDCanvas.php';
require_once '../lib/BackgroundStyle.php';

// Definitions
$DataSet = new pData;
$Canvas  = new GDCanvas(400, 400);
$Chart   = new pChart(400, 400, $Canvas);
// Dataset
$DataSet->AddPoints(array("Memory", "Disk", "Network", "Slots", "CPU"), "Label");
$DataSet->AddPoints(array(1, 2, 3, 4, 3), "Serie1");
$DataSet->AddPoints(array(1, 4, 2, 6, 2), "Serie2");
$DataSet->AddSeries("Serie1");
$DataSet->AddSeries("Serie2");
$DataSet->SetAbscissaLabelSeries("Label");

$DataSet->SetSeriesName("Reference", "Serie1");
$DataSet->SetSeriesName("Tested computer", "Serie2");

// Initialise the graph
$Chart->setFontProperties("../Fonts/tahoma.ttf", 8);
$Chart->setGraphArea(30, 30, 370, 370);

// Draw the radar graph
$Chart->drawRadarAxis($DataSet->GetData(), $DataSet->GetDataDescription(), TRUE, 20, new Color(120), new Color(230));
$Chart->drawFilledRadar($DataSet->GetData(), $DataSet->GetDataDescription(), 50, 20);

// Finish the graph
$Chart->drawLegend(15, 15, $DataSet->GetDataDescription(), new Color(255));
$Chart->setFontProperties("../Fonts/tahoma.ttf", 10);
$Chart->drawTitle(0, 22, "Example 8", new Color(50), 400);

$Chart->Render("Example8.png");
header("Content-Type:image/png");
readfile("Example8.png");