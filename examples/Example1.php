<?php
/**
 * Example 1: A simple line chart
 */

// Standard setup
$DIR = dirname(__FILE__);
if(!defined('OUTDIR')) define('OUTDIR', $DIR);
require_once("$DIR/../lib/pChart.php");

// Definitions
$DataSet = new pData;
$Canvas  = new GDCanvas(700, 230);
$Chart   = new pChart(700, 230, $Canvas);
// Dataset
CSVImporter::importFromCSV($DataSet, "$DIR/../sample/bulkdata.csv", ",", array(1, 2, 3), FALSE, 0);
$DataSet->AddAllSeries();
$DataSet->SetAbscissaLabelSeries();
$DataSet->setSeriesName("January", "Serie1");
$DataSet->setSeriesName("February", "Serie2");
$DataSet->setSeriesName("March", "Serie3");
$DataSet->getDataDescription()->SetYAxisName("Average age");
$DataSet->getDataDescription()->SetYAxisUnit("µs");

// Initialise the graph   
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 8);
$Chart->setGraphArea(70, 30, 680, 200);

// Set Canvas
$Canvas->drawFilledRoundedRectangle(new Point(7, 7), new Point(693, 223), 5, new Color(240), 1, 0, ShadowProperties::NoShadow());
$Canvas->drawRoundedRectangle(new Point(5, 5), new Point(695, 225), 5, new Color(230), 1, 0, ShadowProperties::NoShadow());
$Chart->drawGraphBackground(new BackgroundStyle(new Color(255), true));
$Chart->drawScale($DataSet, ScaleStyle::DefaultStyle(), 0, 2);
$Chart->drawGrid(new GridStyle(4, TRUE, new Color(230), 50));

// Draw the 0 line   
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 6);
$Chart->drawTreshold(0, new Color(143, 55, 72), TRUE, TRUE);

// Draw the line graph
$Chart->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
$Chart->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 3, 2, new Color(255));

// Finish the graph   
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 8);
$Chart->drawLegend(75, 35, $DataSet->GetDataDescription(), new Color(255));
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 10);
$Chart->drawTitle(60, 22, "Example 1", new Color(50), 585);
$Chart->Render(OUTDIR."/Example1.png");
