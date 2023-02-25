Hühnereier Zähler
=================

This PHP script is a simple tool to track the number of eggs laid by chickens. It stores the egg counts in a file and calculates monthly egg counts for display in a chart. It also generates a WhatsApp message with the egg count for the previous month.

Usage
-----

To use this script, simply include it on a PHP-enabled web server and create a file named `egg_counts.txt` in the same directory as the script. This file will be used to store the egg counts in JSON format.

The script provides a simple HTML form for entering new

---

> write a README.md for github in german of the following script: <?php // Functions for reading and writing egg counts to the data file function read\_egg\_counts\_from\_file($file\_path) { $egg\_counts = array(); if (file\_exists($file\_path)) { $file\_contents = file\_get\_contents($file\_path); if ($file\_contents !== false) { $egg\_counts = json\_decode($file\_contents, true); if ($egg\_counts === null) { $egg\_counts = array(); } } } return $egg\_counts; } function write\_egg\_counts\_to\_file($file\_path, $egg\_counts) { $file\_contents = json\_encode($egg\_counts); if ($file\_contents !== false) { $result = file\_put\_contents($file\_path, $file\_contents); return $result !== false; } return false; } // Function for calculating monthly egg counts function get\_monthly\_egg\_counts($egg\_counts) { $monthly\_counts = array(); foreach ($egg\_counts as $date => $count) { $month = date('Y-m', strtotime($date)); if (!isset($monthly\_counts\[$month\])) { $monthly\_counts\[$month\] = 0; } $monthly\_counts\[$month\] += $count; } return $monthly\_counts; } // Handle form submissions if ($\_SERVER\['REQUEST\_METHOD'\] === 'POST') { $date = $\_POST\['date'\]; $count = intval($\_POST\['count'\]); if (!empty($date) && $count > 0) { $file\_path = "egg\_counts.txt"; $egg\_counts = read\_egg\_counts\_from\_file($file\_path); $egg\_counts\[$date\] = $count; write\_egg\_counts\_to\_file($file\_path, $egg\_counts); } } // read egg counts from the file $file\_path = "egg\_counts.txt"; $egg\_counts = read\_egg\_counts\_from\_file($file\_path); // get monthly egg counts $monthly\_counts = get\_monthly\_egg\_counts($egg\_counts); ?> <!DOCTYPE html> <html> <head> <title>Hühnereier Zähler</title> <style> body { background-color: #f2f2f2; color: #333333; } h1 { color: #555555; } h2 { color: #777777; } label { color: #555555; } button { background-color: #007bff; color: #ffffff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; } button:hover { background-color: #0062cc; } table { border-collapse: collapse; width: 100%; } th, td { text-align: left; padding: 8px; border-bottom: 1px solid #ddd; } tr:hover { background-color: #f5f5f5; } </style> </head> <body> <h1>Hühnereier Zähler</h1> <form method="POST"> <label>Date:</label> <input type="date" name="date" required><br><br> <label>Anzahl:</label> <input type="number" name="count" required> <button type="submit">Save</button> </form> <h2>Gelegte Eier im Monat</h2> <div id="chart\_div" style="width: 900px; height: 500px;"></div> <?php // read egg counts from the file $file\_path = "egg\_counts.txt"; $egg\_counts = read\_egg\_counts\_from\_file($file\_path); // get monthly egg counts $monthly\_counts = get\_monthly\_egg\_counts($egg\_counts); // get the last month's egg count $last\_month = date('Y-m', strtotime('last month')); $last\_month\_count = isset($monthly\_counts\[$last\_month\]) ? $monthly\_counts\[$last\_month\] : 0; // generate a WhatsApp message $message = sprintf("Im letzten Monat haben unsere Hühner %d Eier gelegt. %s", $last\_month\_count, urlencode("🥚🐓🐔")); $whatsapp\_url = "https://wa.me/?text=$message"; ?> <h2>WhatsApp Message</h2> <p>Im letzten Monat haben unsere Hühner <?php echo $last\_month\_count ?> Eier gelegt.</p> <p><button onclick="copyToClipboard('<?php echo $message ?>')">Kopiere die Nachricht</button></p> <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> <script type="text/javascript"> // load the Google Charts library google.charts.load('current', {'packages':\['corechart'\]}); google.charts.setOnLoadCallback(drawChart); function drawChart() { // create a new data table var data = new google.visualization.DataTable(); data.addColumn('string', 'Month'); data.addColumn('number', 'Eier'); // add the monthly egg counts to the data table <?php foreach ($monthly\_counts as $month => $count) { ?> data.addRow(\['<?php echo $month ?>', <?php echo $count ?>\]); <?php } ?> // set chart options var options = { title: 'Gelegte Eier im Monat', curveType: 'function', legend: { position: 'bottom' } }; // create and draw the chart var chart = new google.visualization.LineChart(document.getElementById('chart\_div')); chart.draw(data, options); } function copyToClipboard(text) { // create a temporary input element to copy the text var tempInput = document.createElement("input"); tempInput.value = decodeURIComponent(text); document.body.appendChild(tempInput); tempInput.select(); document.execCommand("copy"); document.body.removeChild(tempInput); // alert the user that the text has been copied // alert("The message has been copied to the clipboard."); } </script> </body </html>

---

Hühnereier Zähler
=================

Dieses PHP-Skript ermöglicht das Zählen von Hühnereiern und das Anzeigen von monatlichen Eiern.

Funktionen
----------

Das Skript enthält folgende Funktionen:

*   `read_egg_counts_from_file($file_path)`: Funktion zum Lesen der Eizählungen aus der Datei `egg_counts.txt`. Gibt ein Array mit den Eizählungen zurück.
*   `write_egg_counts_to_file($file_path, $egg_counts)`: Funktion zum Schreiben der Eizählungen in die Datei `egg_counts.txt`. Nimmt ein Array mit den Eizählungen entgegen und gibt true zurück, wenn das Schreiben erfolgreich war, andernfalls false.
*   `get_monthly_egg_counts($egg_counts)`: Funktion zum Berechnen der monatlichen Eizählungen. Nimmt das Array mit den Eizählungen entgegen und gibt ein Array mit den monatlichen Eizählungen zurück.

Verwendung
----------

Um das Skript zu verwenden, führen Sie es auf Ihrem Webserver aus und rufen Sie es in Ihrem Webbrowser auf. Geben Sie das Datum und die Anzahl der gezählten Eier ein und klicken Sie auf "Speichern".

Die gespeicherten Eizählungen werden in der Datei `egg_counts.txt` gespeichert. Das Skript berechnet automatisch die monatlichen Eizählungen und zeigt sie in einem Diagramm an.

Sie können auch eine WhatsApp-Nachricht generieren, die die Anzahl der im letzten Monat gelegten Eier enthält, indem Sie auf die Schaltfläche "Kopiere die Nachricht" klicken.

Installation
------------

Laden Sie das Skript auf Ihren Webserver hoch und speichern Sie es im öffentlichen Ordner (z. B. `/public_html`).

Erstellen Sie eine Datei namens `egg_counts.txt` im gleichen Ordner wie das Skript. Stellen Sie sicher, dass der Webserver Schreibberechtigungen für diese Datei hat.

Das Skript verwendet die Google Charts API, um das Diagramm anzuzeigen. Stellen Sie sicher, dass Sie eine Internetverbindung haben, um die API zu laden.

------
