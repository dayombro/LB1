<h1>Modul 300 Dokumentation</h1>

<h2>Nemanja Percevic</h2>

### **Einleitung**
Ich hatte die Idee, einen Webserver zu installieren, über welchen ich eine Mail verschicken kann. Danach entwickelte sich diese Idee zu einem Mail-Feedback-Formular, welches man ausfüllen kann und dann wird eine Mail verschickt. Das ganze wurde mit Hilfe von Appache2 und PhpMailer aufgesetzt.

### **Vergleich Vorwissen - Wissenszuwachs/Wissenstand**
Am Anfang vom Modul wusste ich nichts über Git, Vagrant, MarkDown. Den Anfang fand ich sehr mühsam. Ich habe lange gebraucht, um mich einzuarbeiten, zu verstehen, wie Vagrant wirklich funktioniert, usw. Die automatisierte VM-Installation fand ich sehr spannend, vorallem wenn ich mir überlege, wo man das überall anwenden kann und wie viel Zeit man durch das sparen kann.

Ich hatte am Anfang Schwierigkeiten mit vm.synced_folders, um die Files in der VM zu überschreiben. Zum Beispiel das index.php file, welches für die Webseite gebraucht wird, wurde immer als Text in den vorhandenen File kopiert, und nicht als Code auf die VM kopiert. Also musste ich eine neue Lösung suchen. Ich kam dann auf "config.vm.provision :file, source: "sendmail.php", destination: "/tmp/sendmail.php"" und konnte somit eine grosse Herausforderung von mir durchstreichen.


### **Sicherheitsmassnahmen**
Das E-Mail wird verschlüsselt mit dem Übertragungsprotokolls TLS verschickt. Das ist sehr wichtig, damit das E-Mail während der Sendung nicht zu einer dritte Person landet. Im sendmail.php file steht "$mail->SMTPSecure = 'tls';". Mit dieser Zeile wird sichergestellt, dass die E-Mails mit TLS verschlüsselt werden.

### **Testfälle**

| Testfall | Tester | Datum | Resultat |
| :--:|:--:| :--:|:--:|
| Beim Klicken auf der Button soll eine neue Webseite erscheinen | Nemanja Percevic | 21.03.2019 | Neue Webseite wurde erfolgreich geladen |
 Das Feedback-Mail soll beim Klicken auf den Button gesendet werden | Nemanja Percevic | 21.03.2019 | Das Feedback-Mail wurde erfolgreich gesendet |
  Das Mail sollte nicht gesendet werden, sofern keine E-Mail Adresse eingetragen wurde | Nemanja Percevic | 21.03.2019 | Es wird nach der E-Mail Adresse gefragt |

### **Reflexion**
Durch die LB1 konnte ich viele neue Sachen lernen, doch ich musste ebenfalls sehr viel Zeit investieren, da bei der LB1 fast alles neu war. Wie immer konnte ich mit Amauri Valdez sehr gut zusammenarbeiten, da wir bei solchen Aufträgen meistens zusammenarbeiten und uns gut verstehen können. Meiner Meinung nach konnten wir beide sehr viel lernen und uns gegenseitig sehr viel helfen.

### **Resultat**

**Die Webseite:**

![Image](./photo1.png)


**Die zweite Webseite:**

![Image](./photo2.png)

**E-Mail:**

![Image](./photo3.png)