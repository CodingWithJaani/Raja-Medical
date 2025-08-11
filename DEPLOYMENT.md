# 🌐 Raja Medical - Free Hosting Deployment Guide

## 🎯 Best Free Hosting Options

### Option 1: Railway (Recommended) ⭐
- ✅ $5 credit monthly (effectively free)
- ✅ MySQL database included
- ✅ Custom domains
- ✅ Automatic HTTPS

### Option 2: Render
- ✅ Free tier available
- ✅ PostgreSQL database
- ✅ Automatic deployments from Git

### Option 3: Vercel + PlanetScale
- ✅ Static hosting + serverless
- ✅ Free MySQL database
- ✅ Global CDN

---

## 🚂 Railway Deployment (Step-by-Step)

### Step 1: Create GitHub Repository

1. **Create GitHub Account** (if you don't have one)
   - Go to: https://github.com
   - Sign up for free

2. **Create New Repository**
   - Name: `raja-medical`
   - Make it Public
   - Don't initialize with README

3. **Upload Your Project**
   ```bash
   cd C:\xampp\htdocs\raja_medical\raja_medical
   git init
   git add .
   git commit -m "Initial commit - Raja Medical Website"
   git branch -M main
   git remote add origin https://github.com/YOUR_USERNAME/raja-medical.git
   git push -u origin main
   ```

### Step 2: Deploy on Railway

1. **Create Railway Account**
   - Go to: https://railway.app
   - Sign up with GitHub account

2. **Create New Project**
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Choose your `raja-medical` repository

3. **Configure Environment Variables**
   Click on your deployed service → Variables → Add these:
   ```
   APP_NAME=Raja Medical
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:LynRXh8Qjp2FAHbjCaO3Ubi8yaAhGE7H5zpEaldz/6A=
   DB_CONNECTION=mysql
   ```

4. **Add MySQL Database**
   - In your project dashboard
   - Click "New" → "Database" → "Add MySQL"
   - Railway will automatically provide database credentials

5. **Set Custom Domain** (Optional)
   - Go to Settings → Domains
   - Add your custom domain or use Railway subdomain

### Step 3: Database Setup

Railway will automatically:
- Create MySQL database
- Run migrations
- Seed sample data
- Make your site live!

---

## 🎨 Alternative: Render Deployment

### Step 1: Render Setup

1. **Create Render Account**
   - Go to: https://render.com
   - Sign up with GitHub

2. **Create Web Service**
   - New → Web Service
   - Connect your GitHub repository
   - Name: `raja-medical`

3. **Configure Build Settings**
   ```
   Build Command: composer install --no-dev && npm install && npm run build
   Start Command: php artisan serve --host=0.0.0.0 --port=$PORT
   ```

4. **Add Database**
   - Dashboard → New → PostgreSQL
   - Copy database URL

5. **Environment Variables**
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:LynRXh8Qjp2FAHbjCaO3Ubi8yaAhGE7H5zpEaldz/6A=
   DATABASE_URL=your-postgres-url
   ```

---

## 🔧 Pre-Deployment Checklist

### ✅ Files to Update:

1. **Update .env for production**
   - Set APP_ENV=production
   - Set APP_DEBUG=false
   - Set correct APP_URL

2. **Optimize Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Test locally**
   ```bash
   php artisan serve --env=production
   ```

### ✅ Security Settings:

1. **Generate new APP_KEY** (important!)
   ```bash
   php artisan key:generate
   ```

2. **Update Admin Credentials**
   - Change default admin password
   - Use strong passwords

---

## 🌍 After Deployment

### Your Live URLs:
- **Website**: https://your-app-name.up.railway.app
- **Admin**: https://your-app-name.up.railway.app/admin/dashboard

### Admin Access:
- **Email**: admin@rajamedical.com
- **Password**: password (change this!)

### First Steps:
1. Login to admin panel
2. Change admin password
3. Update contact information
4. Add real product images
5. Customize content

---

## 💡 Pro Tips

### Performance:
- Use WebP images for products
- Enable Laravel caching
- Use CDN for static assets

### SEO:
- Add Google Analytics
- Submit to Google Search Console
- Optimize meta descriptions

### Maintenance:
- Regular backups
- Monitor error logs
- Update Laravel regularly

---

## 🆘 Troubleshooting

### Common Issues:

1. **Database Connection Error**
   - Check database credentials
   - Ensure database is created

2. **Assets Not Loading**
   - Run `npm run build`
   - Check file permissions

3. **500 Server Error**
   - Check error logs
   - Verify .env configuration

### Support:
- Railway Docs: https://docs.railway.app
- Render Docs: https://render.com/docs
- Laravel Docs: https://laravel.com/docs

---

## 🎉 Congratulations!

Your Raja Medical website is now live and accessible worldwide! 

🌐 **Share your website**: https://your-app-name.up.railway.app
📱 **Mobile-friendly**: Responsive design works on all devices
🔒 **Secure**: HTTPS enabled automatically
📈 **Scalable**: Can handle increased traffic

---

*Created with ❤️ for Raja Medical*