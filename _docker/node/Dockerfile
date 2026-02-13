FROM node:alpine

# Установка jq для обработки JSON
RUN apk add --no-cache jq

# Создаем директорию для приложения
RUN mkdir -p /app

WORKDIR /app

# Копируем файлы зависимостей
COPY frontend/package*.json ./

# Устанавливаем зависимости как root
RUN npm ci || npm install

# Копируем исходный код
COPY frontend/ .

# Выполняем проверку типов и сборку TypeScript
RUN if [ -f package.json ] && [ -n "$(jq -r '.scripts.build // empty' package.json)" ]; then \
        npm run build; \
    else \
        echo "Скрипт build не найден в package.json"; \
    fi

EXPOSE 3000

CMD ["sh", "-c", "npm run dev -- --host 0.0.0.0 --port 3000"]
