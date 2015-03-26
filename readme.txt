Facil HelpDesk 3.2  June 20, 2014


What is new?
Never use a $ as part of a variable for example password, the configuration file will fail!


Tickets system for PHP/(Mysql) or SQL Server(Facil Help Desk 2.9)

========================================
The entire manual is at includes/FacilHelpDesk.pdf

-Requirements before of installing
-Using the ticket system
-Change log
-Tips
-Tipical errors

Customer Support Software.

Basic Requirements before of Installing
===================================

-Web server with PHP 5.x, PHP with the option of sending emails by mail(),  SMTP,sendmail or qmail, the first is preferred.
- 10 MB of free space, for storing files.
- SMTP accounts for reading emails and creating tickets, if you want to use the email to ticket function,
   you shoud create a cron job for executing: for_cron.php
- An empty  database with username and  password created previously:
- Database Mysql 5.0 or SQL Server 2008(supports only FHD 2.9) with Advanced Services(Full-Text Engine required for searching text in tickets), database requires a few of megabytes.

If you use SQL Server 2008,etc. enable  extension for PHP:  php_mssql and restart the server(valid for Apache web server)

Recommended requirements
=======================

PHP 5, Mysql 5.1, GD 2, Mysql Database without limits,file system different from FAT32


 For installing:
  ===============

 1.- Copy files to your web server (BUT USING FTP, not http),

if you use a Mysql Database
((((((((((((((((((((((((((()
       Execute install.php from your internet browser 
	 2.- Fill these basic fields of [Mysql database]:
           database, host,username, password
 
 	3.-  Finally an Administrator will be created, for this purpose you will have to enter an administrator and password

	That's all

	4.-  Enter to the administrative area:

           index_admin.php with your username and password previously created. Read the manual 

	
((((((((((((((((((((((((((((()

If you use an SQLServer 2008 database
%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
Open SQL server Management Studio,Select an database or create a new one wit user and password
 Run the script:

 dump_SQL_server.sql

After of running the script several tables will be created, now the system is ready

Execute install.php and fill database, host, etc. clic save settings.


%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
The basic installation is ready

Login at:  index_admin.php



End user login: index.php

NOW:

	Create "departaments" and levels of urgency if required.
 	-go to settings, and click save to update configuration.php


IMPORTANT
=========
- Login as administrator and go to Settings,change or save configuration.

- Be carefull with the email address for sending notifications is operative,has filters?.
- Facil HelpDesk internally uses PHPmailer.
- Check if  emails can be sended from PHP, if it fails please contact with your hosting company.

You are not allowed to remove the credit to Facil Helpesk and cromosoft.com except if you make an additional payment.

Using the tickets system
========================
Now you are ready to create tickets, send this url to your users,visitors:

 index.php
The url is relative to the folder that you used to install Facil HelpDesk

Note: Try registration of users, with and without email verification.

That is all.


If you want to use email piping (creates tickets from emails) you should 
      create a new cron job,for this file "for_cron.php"   at intervals, example every 5 minutes. 
	When an email is saved to ticket, a short notification will be sent.
      Now Users who submit by email are able to login to the tickets system, using the user "Unregistered". 


Is recomended "email" method of PHP for email delivery instead of SMTP/Qmail/Sendmail


Change Log
============================================================================
3.2 June 2014 Review compatibility with PHP 5.4, avoid using $ for the password of database
3.1(November 23 2010) Basic or Full Edition
Version 3.1 More compatible with PHP 5.3, deprecated functions were replaced, updated PHP Mailer, fixed bugs with email to ticket, time used for ticket was added at reports(applies only to new tickets),
 for notifications in spanish rename templates_es to templates(delete original folder templates)
version 3.0.2 October 23 2010 Fixed daily reports,fixed two bugs updating profile of end user. 
Version 3.0 (25/) Facil Helpdesk in two flavors: Basic and Full Edition, this version includes SLA and tickets scalation
Version 2.9.9 Not yet compatible with SQLServer 2008,supports levels of departments level 1(lowest), level 2 and level 3(high level)
version 2.9.8 Fixed bug
Version 2.9.7 (11/08/2010) Closed tickets are reopen automatically when an answer from email arrives, login now is possible using Facebook authentication.
Version 2.9 (20/05/2010)  Fixed bugs storing uploaded files.
Version 2.9 Compatible with SQL Server, reports Response time was extented to 30 days, fixed several new bugs from version 2.8 from introduction of ADODB
version 2.8 Links for polls are available for open, closed or both tickets when user open a ticket, now uses ADODB instead of native functions for mysql
version 2.7 Added Last action at the tickets listing, fixed bug searching registered users,more extensions were added for attachments(Office 2007), security was added for file uploads,
Version 2.6.5 Settings: set number of responses for polls,1,2,3,5, disable notif. for every response from end user (avoid confussion), after the first submission,notification for staff from email to ticket, fixed bug with template. 
Version 2.6 Fixed Vulnerabilities shown at: http://milw0rm.com/exploits/9396, add poll for ticket after closing ticket (first Open ticket, answer and check "close" if at settings Users can rate responses if CLOSE_TICKET is selected at settings=>Polls)
new report added: Reports, Staff Member=>Tickets.Here every staff member can check his service.
version 2.5 user insertion is faster, performance report individual and global for staff, internal responses of tickets, fixed bug at for_cron.php, now staff members are able to know if responses were not readed yet a red dot appears.
ersion 2.4.2 Fixed 2 vulnerabilities: form to ticket,languaje injection(lang var),improved form interface.
Version 2.4 Fixed bugs with email decoding at "for_cron.php", added form to ticket, now get tickets from email, to use it create a link to "tickets.php?action=create_form"
Version 2.2.3 Sections of urgency levels,departments, configuration are hidden and disabled for staff members. 
Version 2.2.2 (may 5 2009) File of configurations will keep a constant file size not bigger and bigger every time that you change settings.
Version 2.2.1 Added departament supervisor, when a ticket is assigned a notification is sent to supervisor's departament(new dep.),autoregistering of end users is optional,tracking of actions(open, close,assign, answer) of staff members at reports.
Version 2.2 Fixed vulnerability of email spoofing of function: email ->ticket for_cron.php), added track staff members(reports), and other minor improvements.
version 2.1 PHPmailer was upgraded, it supports TLS/SSL etc.
Version 2.0
You can change the tickets's urgency,assign ETAs for tickets solutions,personalized filters if you want to hide a few of tickets of one or several departments for a while. 
changed:update.php,departaments_filter.php,es.php,en.php,calendarDateInput.js,open.php,tickets2.php,list.php
Version 1.9.5
Search/open tickets by number, search was improved, in the welcome page appears the number of tickets and a  list  with closed tickets without response from you.
 "Unread tickets",if ticket was submitted by email you can get headers of every email that was converted to ticket.
Search tickets by user, go to users, select a user click "profile & history" => ticket submission and get the history of the user.

Version 1.9
Were added canned replies,now the update of Facil HelpDesk will be done with two clicks,and other  minor bugs were fixed.

These files changed:
open.php, tickets.php. tickets2.php, en.php, catadmin.php,editcatalog.php,decatalog.php,
fun_contenidosSql.php,SbSql.inc.php,del_paginas.php, cuerpo_search.php, generator_contents.php, control.php, top2.php, was added control.php

Version 1.7.3

Customized Messages were translated to spanish,was added the function "track ticket" now an unregistered user will be able to track the state of a ticket
inserting ticket ID and a "Key" of 6 digits.In the help desk index.php?action=track

These files changed:

index.php,includes/styles.php, folder languaje,tickets.php, for_cron.php, open


version 1.7.1

- Was added an rtf editor for answering tickets, emoticons are only visible when tickets are opened at your web
 	not by email.
-was improved the On mouse over for better preview of tickets 
-the double quote was removed of email notifications in body
-was fixed a bug with function email to ticket
-for_cron.php was unable to save files of more of one email to ticket when an tickets was created from email and the
 user answered it by email the url had the parameter key instead of key3 and was imposible to open the ticket
-A lot of files were changed so that you should copy all the files.
-the script "for_cron_php" requires Mysql 4.1 or you should disable the feature of "delete spam after 7 days".

Still For fixing: 

-Answering a ticket by email if you are a user the notification contains a new ticket id in the email body.
-Answering a ticket using the online rtf editor closes the session for the Unregistered user when you open the ticket from a link.

 
version 1.6.5 Fixed bug of Piechart and zeros, FHD crashed 
when the subjet of a ticket had javascript, the page of overview
 has more information and were fixed several bugs of "statistics".

to update to version 1.6.3 update of the include folder these files:

reports.php, overview.php,piechart.php,list.php, open.php,styes.php,


Version 1.6 Options for reparing tickets were added, Go to Reports=>Diagnostics

version 1.5 FHD supporsts email atachments, files are stored to database 

September 24 2007, version 1.4

When you assign a ticket to an individual staff member, he will get a notification,
 this function can be disabled in "Settings", in the list of tickets appears who received
the assignmente of a ticket and the ticket will be considered as a new ticket(unread),
was fixed a bug: if we delete a user also is deleted this user of staff members,
now statistics include unread tickets, assigned ticket by departament and staff members,
fixed another eventuall bug: sometimes when was opened a ticket clicking a url from the notification
email was imposible to login and read the ticket,
was fixed it and now unregistered users can open and respond their ticket clicking an url from the notification email,
if we make a ticket assignement only staff members of that departament will be visible.
 

August 26 2007, 1.3.3

Was fixed a bug: tickets created by an administrator didn't save the email of the users, thanks Pedro. 

June 27,2007 version 1.3

Now tickets can be assigned to a individual person of the staff

June 12 2007, version 1.2.7

Was fixed a bug with the number of email converted to tickets, now the limit is imposed by your server.

June 4 2007, version 1.2.5

Was fixed an security risk(every ticket created by email has the ID in the subjet,
was added a verification string to avoid external tickets manipulation)

The preview of tickets now is 200 characters, several minor bugs were fixed.


May 25 2007, version  1.2
Was added basic email piping. email => ticket.

April 2007, version  1.1.5
Fixed bug with cache of images for statistics, search function added for users,website, company added for users. 

What is new with version 1.1

-Limit the number of tickets/day
-Added "offline" of helpdesk, disable the helpdesk when you are doing a backup(with an external tool), restore of database,
 etc.
-Bugs fixed with search of tickets
-Overview of current state of helpdesk(users, tickets)using GD
-Was added a section for "notes"  for users, write about your users and their preferences.Because your users are people
 not "tickets".
-Colors can be changed from "settings"
-Other minor improvements were done.

March 2007, version 1.0
The ticket system is ready, only for use at cromosoft.com

Tips
===
-You can create several users with the same email and  when we use the option  "Send Login information

to your email" (at index.php), the login information is selected for the LAST USER created with that email.

-In few servers file uploads fails.
If PHP mailer fails, disable:

		IF (file_exists('includes/language/phpmailer.lang-en.php'))
			{$mailzz -> SetLanguage('en', 'includes/language/');
			}
		   ELSE
			{$mailzz -> SetLanguage('en', '../includes/language/');			
			}
			
in the file: \includes\functions.php


Tipical errors
==============
- If you are the administrator you will be able to open the ticket, give an answer but to assign a ticket to other
 departament you need permissions on the departament.
- If email notifications fails, ask to your hosting provider how to send email from PHP

- If you get the clasic Forbidden error accessing a file or folder, please set proper permissions at the file(include, image) or folder.
specially with:
 
/images/map1.png
/images/map2.png
/upload/
Fckeditor
- if you get the error "Fatal error: Call to a member function read() on a non-object in D:\wamp\www\tickets\includes\open.php on line 483" , please check if your installation 
have a valid path for "upload path", example:   upload/



For more details and CLUF  open includes/manual.htm

table categories added field levels

September 2010 Cromosoft Technologies. cromosoft.com
