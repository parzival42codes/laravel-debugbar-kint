# laravel-kint

Laravel Kint ist ein Wrapper für Kint (https://github.com/kint-php/kint), einem Debugger für PHP.

Über die Function kd() wird eine Instanz des Wrappers aufgerufen.
Dadurch stehen folgende Methoden zur Auswahl:

## collection(string|null $dumpCollectionKey = 'default')

Setzt die aktuelle Dump Collection, es können beliebig viele erzeugt werden.

Reserviert sind:

- **debugbar()** # 'debugbar', Setzt die Collection auf 'debugbar'. Es ist eine Einbindung für die Debugbar von
  Barryvdh\Debugbar.
- **log()** # 'log', Schreibt die Ausgabe in einen Logchannel.

## dump (mixed $dump, ?array $context)

Nimmt den Dump auf und ggf. einen Context als Array.

Der schlüssel '_' im Context wird als Titel genommen.

## render()

Erzeugt eine Bildschirmausgabe.

## logWrite()

Schreibt das Log

## output()

Gibt den Output als String zur aktuellen Dump Collection zurück.

## outputAsArray()

Gibt den das Array zur aktuellen Dump Collection zurück.

## getCount()

Gibt die Anzahl der Einträge im Array zur aktuellen Dump Collection zurück

## die()

Beendet den Script durchlauf / bricht ab.