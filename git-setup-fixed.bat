@echo off
echo 🏥 Raja Medical - Git Repository Setup (Windows Fixed)
echo.

echo 🔧 Configuring Git for Windows...
git config core.autocrlf true
git config core.safecrlf false
git config --global core.preloadindex true
git config --global core.fscache true

echo 🧹 Cleaning up any problematic files...
if exist nul del /q nul
if exist .git\index del /q .git\index

echo 📁 Initializing Git repository...
git init

echo 📋 Checking Git status...
git status

echo 📝 Adding files (excluding problematic ones)...
git add --all

echo 💾 Creating initial commit...
git commit -m "Initial commit - Raja Medical Website"

echo 🌿 Setting main branch...
git branch -M main

echo.
echo ✅ Git repository setup completed successfully!
echo.
echo 📋 Next steps:
echo 1. Go to GitHub.com and create a new repository named 'raja-medical'
echo 2. Copy and run these commands:
echo.
echo    git remote add origin https://github.com/YOUR_USERNAME/raja-medical.git
echo    git push -u origin main
echo.
echo 🌐 Then visit railway.app to deploy your website
echo.
pause