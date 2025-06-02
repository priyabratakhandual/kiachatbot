pipeline {
    agent any

    stages {
        stage('Clone') {
            steps {
                git 'https://github.com/priyabratakhandual/kiachatbot.git'  // replace this
            }
        }

        stage('Build & Deploy') {
            steps {
                sh 'docker-compose down'
                sh 'docker-compose up -d --build'
            }
        }

        stage('Laravel Setup') {
            steps {
                sh 'docker exec kiachatbot_app php artisan config:clear'
                sh 'docker exec kiachatbot_app php artisan config:cache'
                sh 'docker exec kiachatbot_app php artisan route:cache'
            }
        }
    }
}
