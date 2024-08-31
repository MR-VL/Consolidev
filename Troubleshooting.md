# Random errors I ran into

### 1. Db credentials

username: root<br>
password: 

### 2. Make sure skype or P2P applications are not running in background. They will cause errors with MySQL

### 3. MySQL running at startup breaking WAMP MySQL
```markdown
At least on my computer mysql was set to auto start resulting in an issue that completely broke wamp server mysql variant due to them running on same port 3306.

Windows key +R
services.msc
Scroll until you find mysql{version}
double click on it
Change startup to manual
Apply and close all tabs
Restart computer
```