@echo off
echo 🏥 Raja Medical - Git Repository Setup
echo.

echo 📁 Initializing Git repository...
git init

echo 📝 Adding all files...
git add .

echo 💾 Creating initial commit...
git commit -m "Initial commit - Raja Medical Website with Admin Panel"

echo 🌿 Setting main branch...
git branch -M main

echo.
echo ✅ Git repository initialized successfully!
echo.
echo 📋 Next steps:
echo 1. Create a new repository on GitHub named 'raja-medical'
echo 2. Run: git remote add origin https://github.com/YOUR_USERNAME/raja-medical.git
echo 3. Run: git push -u origin main
echo.
echo 🌐 Then deploy on Railway or Render following the DEPLOYMENT.md guide
echo.
pause