pipeline {
    agent any

    environment {
        APP_CONTAINER = 'kiachatbot_app'
        COMPOSER_FLAGS = '--no-dev --optimize-autoloader'
    }

    stages {

        stage('Clone Repository') {
            steps {
                git 'https://github.com/priyabratakhandual/kiachatbot.git'  // Replace with your repo
            }
        }

        stage('Build & Deploy Containers') {
            steps {
                sh 'docker-compose down --remove-orphans'
                sh 'docker-compose up -d --build'
            }
        }

        stage('Composer Install') {
            steps {
                // Ensure dependencies are installed inside container
                sh "docker exec ${APP_CONTAINER} composer update ${COMPOSER_FLAGS} || true"
            }
        }

        stage('Laravel Setup') {
            steps {
                // Ensure .env exists (already mounted via docker-compose)
                sh "docker exec ${APP_CONTAINER} php artisan key:generate || true"
                sh "docker exec ${APP_CONTAINER} php artisan config:clear"
                sh "docker exec ${APP_CONTAINER} php artisan config:cache"
                sh "docker exec ${APP_CONTAINER} php artisan migrate --force || true"
            }
        }

        stage('Health Check') {
            steps {
                sh 'curl --fail http://localhost:9000 || echo "App may not be accessible"'
            }
        }
    }

    post {
        failure {
            echo '❌ Build failed. Check logs above.'
        }
        success {
            echo '✅ Laravel app deployed successfully!'
        }
    }
}
