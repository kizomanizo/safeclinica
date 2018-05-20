# SafeClinica #
SafeClinica is an *Electronic Medical Record System* suitable for low resource settings.
It is made for clinics with single computer or tablet mostly at the registration. The application is made with Laravel 5.4 using Eloquent ORM primarily while views are strictly in Blade and Javascript. The styling is basicaly done using a free template called *Paper Theme* obtained on the wilds of the internet. Graphs are rendered using *Charts.js* Javascript library.


## Scalability ##
We have also set it for scalling up, it can also be deployed in a setting where there is more than one computer or tablet. In this setting different modules can be accessed by different people in the clinic. It currently hosts the capacity for:
1. Registration
2. Doctor's room
3. Pharmacy
4. Laboratory
5. Management


## Installing SafeClinica

### Update
Put this folder in your apache like explained below in previous directions. Also create the .env file as described below in old installation instructions. That is it, go to your browser and type `localhost/safeclinica/public` the installation process will complete automatically by following numbered clicks.

At the moment the app is in development, installing it has been simplified but it will be even more better when it has been completed and RC1 has been left in the wild. In the meantime, it can be installed in this process.

### Dependencies ###
For this application to work, you need to have *Apache* and *Mysql*. You can read the documentation on how to install apache and mysql online.

### Downloaded files ###
Place these files you have downloaded from this repo in your apache htdocs folder depending on the system you are operating.
#### Windows: ####
Place the safeclinica folder in `C:\xampp\htdocs`
#### Linux: ####
Place safeclinical downloaded folder in /var/www/html if you use desktop mouse and keyboard or if you use command then execute the following commands:
`sudo apt-get install git`
this will install git if it is not in your system(type your computer password when prompted)
`cd /var/www/html`
this will move your current directory to where you should place safeclinica folder
`git clone https://github.com/kizomanizo/safeclinica`
this will download safeclinica and put it in you system.

### Configuration: ###
1. Via mysql create a new and empty database called *safefocus*
2. In a text editor open a file called *.env.example* and scroll to where mysql database is defined and put in there your database username e.g. _root_ and your database password. Save this file as *.env* removing the '.example' extension.
3. Open command line or terminal then go to the root folder you have just put in apache i.e.
`cd C:\xampp\htdocs\safeclinica\` for Windows
`cd /var/www/html/safefocus` for Linux.
Once there, to get an empty application that you can start to use for your personal uses type:
`php artisan migrate`
To get a demo application with bogus data inside do not stop there, once the migrate command is executed, run this command:
`php artisan db:seed`
When the command above completes; ___(it may take a minute or two!)___ go ahead and close the terminal window.
4. Open your browser preferably Chrome or Firefox and go to *http://localhost/safeclinica/public* your application will open up and you may be prompted to register new users for an empty applicaion or log-in for a demo application. For demo application, the username is *administrator* and the password is *safeclinica*.

## Using the application ##
*Usage docs will come up soon!*

## License ##
[GNU General Public License (GPL)](https://opensource.org/licenses/GPL-3.0)

Written by [Bwana Kizito](http://twitter.com/kizomanizo)
