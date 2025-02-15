# PHP 8.3 の公式イメージを使用
FROM php:8.3-apache

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# zip拡張とunzip, gitをインストール
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
    && docker-php-ext-install zip

# 作業ディレクトリ
WORKDIR /var/www/html

# ホストのファイルをコンテナ内にコピー
COPY src/ /var/www/html

# ポート80を公開
EXPOSE 80

# Apacheを起動
CMD ["apache2-foreground"]
