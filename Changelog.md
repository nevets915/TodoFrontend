#Change Log

#####Team membership:  

    - GL[Jia Qi Lee (NamBlue)] (Captain)
    - SM[Steven Ma] (Mate)

Team conventions: Allman notation, markdown for changelog  
Changelog format: [Markdown](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet) 

## Version Log

### Version 5.0 - GL, SM
Release Date: 11.02.17

##### New Components
    - core/REST_Model
        - REST client code for CRUD functionality implemented

##### Updated components
    - models/Tasks
        - now uses REST model instead

##### Comments
	- This application is now a client-only application that uses REST to view/modify data

### Version 4.0 - GL, SM
Release Date: 11.02.17

##### New Components
    - others
        - Added tasks.xml
	- Added XML_Model.php

##### Comments
	- Stored data is now in xml now instead of csv

### Version 3.0 - GL, SM
Release Date: 11.02.17

##### New Components
    - others
        - Added PhpUnit testing to project
        - Added build/test automation with Travis CI
	- Added TaskListTest
	- Added TaskTest

##### Updated components
    - model     
        - Tasks - Added getCompletedTasks, setTask, setPriority, setSize, setGroup

### Version 2.0 - GL, SM
Release Date: 10.19.17

##### New Components
    - controllers     
        - Mtce - Maintenance controller
        - Roles
    - model     
        - N/A
    - view
        - itemlist - displays lists on oneitem
        - oneitem - displays one row
        - oneitemx - displays editable row
	- itemnav - displays page navigation
        - itemadd - displays add entries button
	- itemedit - displays items worked with
    - others
        - N/A

##### Updated components
    - controllers
        - Mtce - Shows role on pagetitle
               - Added pagination
               - Added framework for Adding/Editing entries
	       - Added add, edit, showit, submit cancel and delete functions
	       - View - updated makePrioritizedPanel() 
               - created complete()
               - Showit() now also handles Size, Group and Status fields
    - model     
        - Tasks - Added rules for validation
    - view
        - _menubar - added role selector
        - itemlist - added pagination tag
        - by_priority - added form tag
        - itemedit - added Size Group and Status form fields
    - others
        - autoload - enabled sessions
        - config - Changed link routing for Maintenance
                 - Session path set
        - constants - Added application constants
	- Memory_model - updated highest function
	- updated core/Memory_Model
        

##### Bugfixes
    - controllers
        - N/A    
    - model     
        - App - fixed bugs required by step 10.0
    - view
        - Fixed bootstrap for
    - others
	- Fixed bugs for Memory_model $data to $record

### Version 1.0 - GL, SM
Release Date: 10.12.17

##### New Components
    - controllers     
        - Views
        - Helpme
    - model     
        - Added Tasks.php
    - view
        - by_priority
        - by_category
    - others
        - data/jobs.md
        - imported liraries/Parsdown.php

##### Updated components
    - controllers     
        - Updated Welcome.php
        - MY_Controller - fixed bug
        - 
    - model     
        - N/A
    - view
        - Updated homepage.php
    - others
        - config - Changed link routing for work link
                 - Changed link to route Help Wanted link
        - autoload - Added reference to load Parsedown library