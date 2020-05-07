# WitCom Plugin Starter

Starter plugin for use with witdigital/wit-commander-plugin

## Notes

*  Work only in the develop branch.
*  Master branch on github does a production build when pushed to.
*  Use the release/xxx scheme for incremental releases.
*  Deployment and Plugin Update process not yet documented.<!--todo add deployment and plugin update docs-->
*  Submodules for different block types that will be able to be dropped in are being created.
*  Empty folders exist for a more uniform structure across different WitCom plugins.

>   Deployment and the plugin update process are not yet documented.<!--todo add deployment and plugin update docs-->
  develop and master have different ignores. Build files are committed in Master. Merge from develop to master in local and force push to origin to force master to build the latest version.
 
 
## Creating a new WitCom Plugin Project
1. Create new repository
2. Configure new repository
3. Setup local repository
4. Update Project files for new plugin
5. Initial Project Commit
6. Setup master branch



### 1. Create New Repository:

https://github.com/new/import
![](https://i.imgur.com/e9sHg99.jpg)

```https://github.com/witdigital/witcom-plugin-starter```

* **Owner:** witdigital
* **Name:** witcom-newpluginname
* **Privacy** Private


2. Click on new repository name and login

 ![](https://i.imgur.com/IlE1zcI.jpg)


3. Click on name again and wait 15-30 seconds

 ![](https://i.imgur.com/dfwPA1T.jpg)

1. Click on name again to load up the new repo.

### 2. Configure new repository:

1. Add Description
2. Enable Actions
3. Change Default branch to develop
4. Delete master branch

### 3. Setup local project:

1. In local wp-content/plugins clone the new project repo

```git clone https://github.com/witdigital/[repoName].git```

2. Setup branch specific ignore functionality.
    1. Create file post-checkout in .git/hooks

        Content here: https://github.com/witdigital/witdev-files/blob/master/misc-helpers/post-checkout

    2. Make post checkout executable 

        ```chmod 755 post-checkout``` or ```chmod 755 .git/hooks/post-checkout```

### 4. Update Project files for new plugin

1. Open project in IDE
2. If applicable rename project in IDE
3. Rename main plugin file and open
    1. Update Name
    2. Update Description
4. Open readme.txt
    1. Update Name
    2. Update Descriptions
5. Open package.json
    1. Update Name
    2. Update Descriptions
6. Open composer.json
    1. Update Name
    2. Update Descriptions
7. Perform Find replaces 

    ```witcom_starter to witcom-[newPLuginName]```
    ```witcom-starter to witcom_[newPLuginName]```

### 5. Initial Project Commit 

    git commit -a -m "start witcom-[newPLuginName]"
    
### 6. Setup master branch 

1. Create master branch and manually checkout

   ```git branch master```

    ```checkout master``` (this will update the ignores for the master branch)

2. Switch back to develop branch
 
    ```checkout develop``` (this will update the ignore for the develop branch)

### 7. Push all branches to github

1. Push all branched
    
    ```git push --all origin```
    
    Force push necessary: ```git push --all origin --force ```
    
    
### 8. Check that master action is working

When action is complete check the master branch for a commit. "Automated publish: xxxxx"

You are almost done!


### 9. Test in local envrionment

    
1. activate plugin - it should activate, but not really work
2. composer install
3. npm install
4. Test the three scripts
    1. npm run prod
    2. npm run dev
    3. npm run watch

    Load front end of site. If all is well would will get a javascript alert with the plugin name. Disable this in src/assets/scripts/app.js
    
    ### 10. Delete this file.
    1. Delete README.md use readme.txt or recreate if necessary



