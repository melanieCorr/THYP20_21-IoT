# Water-Quality-Monitoring-System

Website of water quality monitoring system using Arduino, C, PHP, AngularJS and Python.

A part of final year project KICT, IIUM


## Project Requirements:
* Arduino 
    * Arduino board files [Download here](https://github.com/atifmustaffa/Water-Quality-Monitoring-System-Arduino)
    
* Python 3 - _**Python 3.6.0** is used in this project_
    * Python ```requests``` package [Official Site](http://docs.python-requests.org/en/v2.7.0/user/install/)
    * Python ```pyserial``` package [Official Site](https://pyserial.readthedocs.io/en/latest/pyserial.html)
    
* PHP - _**PHP 7.2.10** is used in this project_

* SQL Database Server - _Read ```sql.txt``` and ```sql2.txt``` for database and table setup_

## Installation
#### Setting up Windows Environment Variable (Only for Windows)
** _If you have python path configured in **Windows Environment Variables**, you may skip this part and proceed to [installation of required python packages](#install-required-python-packages) below_
1.  Find **Python Path OR Python Installation Location**
    Example of Python 3.7.0 default location:
    ```
    C:\Users\<username>\AppData\Local\Programs\Python\Python37-32
    ```
1.  **Save/Copy** the path **Make sure you see ```python.exe``` in the folder
1.  Open the Windows **Advanced system settings**.
1. In Advanced tab, find and click **Environment Variables**.
1. In the section **System Variables**, find the **PATH** environment variable and select it.
1. Click Edit. If the **PATH** environment variable does not exist, click New.
1. In the **Edit Environment Variable** (or New System Variable) window, click **New** and **insert OR paste** your Python path/installation location. Click OK. Close all remaining windows by clicking OK.
1. You can now access Python through Command prompt window(CMD).
1. To test if it is working, reopen Command prompt window and run command:
    ```
    python --version
    ```
    and it should display the current version of Python installed
#### Install required Python packages
* For automatic installation, open ```install-package.bat``` and wait until it completes
* For manual installation, on Command prompt window, run:
    1. Python **requests** package
        ```
        python -m pip install requests
        ```
    2. Python **pyserial** package
        ```
        python -m pip install pyserial
        ```
## Getting Started
** _Configure project website settings in ```config.php``` file_

** _Configure arduino **serial port** and **website host address** in ```serialread.py``` file_

** _Run/Open ```serialread.py```_
