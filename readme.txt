[Git useful commands]

-- Start-up ---------------------------------------------------

1.) Set-up identity
 git config --global user.name "Janet Napoles"
 git config --global user.email janetnapoles@porkbarrel.com
	
2.) Copy or create new project
 commands:
 a.)clone - Copy and existing project to your selected directory
  git clone https://github.com/username/projectname.git
 b.)init - Initialize git in your project
  cd /path/to/your/project/folder
  git init
  
  

-- Basic routine(add/commit/push/pull) ----------------------------	
	
1.) Add file to the staging area
 a.)Add a single file
  git add filename
 b.)Add all files
  git add .
 c.)Add all files, will also let you tracked the removed files
  git add --all 
  
2.) Commit 
 a.) git commit -m "your message"
 - Add staged file to your local repository, and put a comment	
 b.) git commit -a -m "your message"
 - Automatically add file commit
 
3.) push
 - (upload) push your local repository files to remote repository
 git push remote_repository_name your_branch

4.) pull
 - (download)pull files from a remote repository
 git pull remote_repository_name your_branch
 
 


-- Misc ------------------------------------------------------------

1.) Check repository status
 git status

2.) Check file difference
 a.)git diff
 - Compare your current file to the stage file
 b.)git diff --cached
 - See the changes on the staging area so far

3.) Add remote repository address
 a.)add 
  git remote add remote_repository_name https://github.com/username/projectname.git
 b.)rename
  git remote rename old_repository_name new_repository_name
 c.)remove
  git remote remove remote_repository_name
 d.)display remote list
  git remote 
   - list all remotes
  git remote -v
  - list all remote name and url
 
4.) View commit history
 ref: http://git-scm.com/book/en/Git-Basics-Viewing-the-Commit-History
 git log
 a.) no parameter
  - display all of commits
 b.) -p -2
  - display difference in each commit, limits last 2 entries
 c.) --pretty=oneline
  - display only the hash number the the commit message
 d.) --pretty=format:"%h -  %an, %ar : %s"
  - formats commits into <hash> - <authorname>, <date> : <subject> the format is highly customizable, see reference for the output format
 e.) --graph
  - display an ASCII graph 
 f.) --author=author_name
  - display commits for a specific author
  
5.) Undo 
 a.) git commit --amend 
  - appends newly added file in this type of commit
 b.) git reset HEAD filename
  - unstage tracked file
 c.) git checkout -- filename
  - unmodifiying the modified file or undo changes of your file back to the last commited state

 

	
		