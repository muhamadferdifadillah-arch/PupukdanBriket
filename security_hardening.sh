#!/bin/bash

# ============================================
# SECURITY HARDENING SCRIPT
# ============================================
# Script untuk mengimplementasikan security hardening pada sistem Linux/Ubuntu
# Pastikan menjalankan script ini dengan sudo privileges

echo "=========================================="
echo "    SECURITY HARDENING SCRIPT"
echo "=========================================="

# 1. Update system packages
echo "[*] Updating system packages..."
sudo apt-get update
sudo apt-get upgrade -y

# 2. Install firewall & enable UFW (Uncomplicated Firewall)
echo "[*] Installing UFW firewall..."
sudo apt-get install -y ufw
sudo ufw default deny incoming
sudo ufw default allow outgoing
sudo ufw allow 22/tcp    # SSH
sudo ufw allow 80/tcp    # HTTP
sudo ufw allow 443/tcp   # HTTPS
sudo ufw enable

# 3. Install Fail2Ban untuk mencegah brute force attacks
echo "[*] Installing Fail2Ban..."
sudo apt-get install -y fail2ban

# 4. Configure SSH Hardening
echo "[*] Configuring SSH security..."
sudo sed -i 's/#PermitRootLogin yes/PermitRootLogin no/' /etc/ssh/sshd_config
sudo sed -i 's/#PasswordAuthentication yes/PasswordAuthentication no/' /etc/ssh/sshd_config
sudo sed -i 's/#PubkeyAuthentication yes/PubkeyAuthentication yes/' /etc/ssh/sshd_config
sudo systemctl restart ssh

# 5. Install ClamAV antivirus
echo "[*] Installing ClamAV antivirus..."
sudo apt-get install -y clamav clamav-daemon
sudo freshclam  # Update virus definitions
sudo systemctl start clamav-daemon

# 6. Install AIDE untuk file integrity monitoring
echo "[*] Installing AIDE..."
sudo apt-get install -y aide aide-common
sudo aideinit

# 7. Configure automatic security updates
echo "[*] Enabling automatic security updates..."
sudo apt-get install -y unattended-upgrades
sudo dpkg-reconfigure -plow unattended-upgrades

# 8. Harden kernel parameters
echo "[*] Hardening kernel parameters..."
sudo sysctl -w net.ipv4.conf.all.send_redirects=0
sudo sysctl -w net.ipv4.conf.default.send_redirects=0
sudo sysctl -w net.ipv4.conf.all.accept_source_route=0
sudo sysctl -w net.ipv4.conf.default.accept_source_route=0
sudo sysctl -w net.ipv4.conf.all.accept_redirects=0
sudo sysctl -w net.ipv4.conf.default.accept_redirects=0
sudo sysctl -w net.ipv4.conf.all.secure_redirects=0
sudo sysctl -w net.ipv4.conf.default.secure_redirects=0

# 9. Configure logrotate untuk manage log files
echo "[*] Configuring logrotate..."
sudo logrotate /etc/logrotate.conf -f

# 10. Install Nginx ModSecurity untuk WAF (Web Application Firewall)
echo "[*] Installing ModSecurity..."
sudo apt-get install -y libnginx-mod-security
sudo systemctl restart nginx

echo "=========================================="
echo "    SECURITY HARDENING COMPLETE!"
echo "=========================================="
echo "Catatan penting:"
echo "1. Pastikan SSH key sudah di-setup sebelum menonaktifkan password login"
echo "2. Regular update sistem dan dependencies"
echo "3. Monitor log files untuk suspicious activities"
echo "4. Regular security audits & penetration testing"
echo "=========================================="
