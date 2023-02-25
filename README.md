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
