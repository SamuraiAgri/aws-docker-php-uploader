# PHP 8.3 の公式イメージを使用
FROM php:8.3-apache

# 作業ディレクトリを指定
WORKDIR /var/www/html

# ホストのファイルをコンテナ内にコピー
COPY src/ /var/www/html

# ポート80を公開
EXPOSE 80

# Apacheを起動
CMD ["apache2-foreground"]
