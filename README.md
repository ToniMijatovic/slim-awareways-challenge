# Awareways Challenge
This repository contains a Slim application that can be easily launched using Docker. It provides a simple setup for running this Slim app in a containerized environment.

# Prerequisites
Make sure you have the following software installed on your machine:

- Docker
- Docker Compose
# Getting Started
Follow the steps below to get the Laravel app up and running:

1. Clone this repository to your local machine: `git clone https://github.com/ToniMijatovic/slim-awareways-challenge`
2. Copy the .env.example file to .env: `cp .env.example .env`
3. Build and start the Docker containers: `docker-compose up -d --build`
4. Obtain the container ID, run the following command: `docker ps`
5. Access the container shell by running the following command: `docker exec -it <container_id> bash`
6. Run the database migrations: `vendor/bin/phinx migrate -e development`
7. Run the client table seeder: `vendor/bin/phinx seed:run -s ClientsSeeder`
8. Get out of the container and open your web browser and visit http://localhost:9101 to see the running Slim app.

Note: No changes are required in the .env file for the database credentials if you are following the docker steps.

# Slim PHP Project Installation without docker
If installing with Docker for some reason did not work, you can follow these steps to do it on the regular way.

## Prerequisites

Before proceeding with the installation, ensure that you have the following software installed on your machine:

- PHP 8.1 or greater(accessible with CLI)
- Composer 2
- A MySQL database

## Installation Steps

Follow these steps to install the Laravel PHP project:

1. Clone this repository to your local machine: `git clone https://github.com/ToniMijatovic/slim-awareways-challenge`
2. Navigate to the project directory: `cd slim-awareways-challenge`
3. Install PHP dependencies using Composer: `composer install`
4. Copy the `.env.example` file to `.env`: `cp .env.example .env`
5. Modify the `.env` file with the necessary database configuration settings.
6. Run database migrations: `vendor/bin/phinx migrate -e development`
7. Run the client table seeder: `vendor/bin/phinx seed:run -s ClientsSeeder`
8. Start the development server: `php -S localhost:9101 -t public index.php`

The Laravel development server will be running at `http://localhost:9101`.

# API Documentation: Create quiz

This documentation provides information on how to use the two endpoints which are defined in the application.

## Endpoint

POST /api/v1/quiz

## Request Parameters

| Parameter                           | Type    | Description                                                                         | Required | Possible Values                           |
|-------------------------------------|---------|-------------------------------------------------------------------------------------|----------|-------------------------------------------|
| quiz_name                           | string  | The name of the quiz                                                                | Yes      | "Phising Quiz"                            |
| quiz_id                             | int     | When using this it will update the existing quiz                                    | Yes      | 1,2,3 .. and so on                        |
| client_id                           | int     | Id of the client                                                                    | Yes      | 1,2,3 .. and so on                        |
| questions                           | array   | Array of all questions of the quiz                                                  | No       |                                           |
| questions.*.text                    | string  | This is the question text                                                           | No       | What is the capital of France?            |
| questions.*.type                    | string  | This is the question type                                                           | No       | "Multiple Choice", "Order", "Drag & Drop" |
| questions.*.question_id             | integer | When using this it will update an existing question                                 | No       | 1,2,3 .. and so on                        |
| questions.*.answers                 | array   | This is the array of answers                                                        | No       |                                           |
| questions.*.answers.text            | string  | This is the answer text                                                             | No       | France                                    |
| questions.*.answers.is_correct      | bool    | This indicates if an answer is correct or not, defaults to true                     | No       | true, false                               |
| questions.*.answers.text            | string  | This is the answer text                                                             | No       | France                                    |
| questions.*.terms                   | array   | This is the terms array, used for when the question type is Drag & Drop             | No       |                                           |
| questions.*.terms.text              | string  | This is the term                                                                    | No       | Term 1, Term 2, Term 3, ect.              |
| questions.*.terms.term_id           | int     | When using this it will update the existing term                                    | No       | 1,2,3 .. and so on                        |
| questions.*.topics                  | array   | This is the topics array, used for when the question type is Drag & Drop            | No       |                                           |
| questions.*.topics.text             | string  | This is the topic                                                                   | No       | Topic 1, Topic 2, Topic 3, ect.           |
| questions.*.topics.topic_id         | int     | When using this it will update the existing topic                                   | No       | 1,2,3 .. and so on                        |
| questions.*.answers.topics          | array   | This is the topics array, used for when the question type is Drag & Drop            | No       |                                           |
| questions.*.allocations.term_index  | int     | An index from the previously declared terms array, used to make a pair with a topic | No       | 1,2,3 .. and so on                        |
| questions.*.allocations.topic_index | int     | An index from the previously declared topics array, used to make a pair with a term | No       | 1,2,3 .. and so on                        |

## Response

The response will be a JSON object with a message indicating the result.

Example request body:

```json
   {
      "quiz_name": "Quiz 1",
      "client_id": 1,
      "questions": [
        {
          "text": "What is the capital of France?",
          "type": "Multiple Choice",
          "answers": [
            {
              "text": "Amsterdam",
              "is_correct": false
            },
            {
              "text": "Paris",
              "is_correct": true
            },
            {
              "text": "Zagreb",
              "is_correct": false
            }
          ]
        },
        {
          "text": "Put the following steps in order.",
          "type": "Order",
          "answers": [
            {
              "text": "Step 1"
            },
            {
              "text": "Step 2"
            },
            {
              "text": "Step 3"
            }
          ]
        },
        {
          "question_id": 3,
          "text": "Drag and drop the terms into their respective topics.",
          "type": "Drag & Drop",
          "terms": [
            {
              "text": "Term 1",
              "term_index": 0
            },
            {
              "text": "Term 2",
              "term_index": 1
            },
            {
              "text": "Term 3", 
              "term_index": 2
            }
          ],
          "topics": [
            {
              "text": "Topic A",
              "topic_index": 0
            },
            {
              "text": "Topic B",
              "topic_index": 0
            }
          ],
          "allocations": [
            {
              "term_index": 1,
              "topic_index": 1
            },
            {
              "term_index": 2,
              "topic_index": 2
            },
            {
              "term_index": 3,
              "topic_index": 2
            }
          ]
        }
      ]
    }
```


Successful response:

```json
{
  "message": "Successfully created a quiz for a client."
}
```
Failed responses:

```json
{
  "message": "Some parameters are missing, please try again."
}
```
```json
{
  "message": "Something went wrong whilst trying to create a quiz for a client."
}
```

## Endpoint

POST /api/v1/quiz/{id}/submit

## Request Parameters

| Parameter             | Type   | Description                                                                          | Required | Possible Values    |
|-----------------------|--------|--------------------------------------------------------------------------------------|----------|--------------------|
| id                    | int    | Id of the quiz, this is a url parameter                                              | Yes      | 1,2,3 .. and so on |
| client_id             | int    | Id of the client                                                                     | Yes      | 1,2,3 .. and so on |
| date                  | string | Id of the client                                                                     | Yes      | "2023-07-09"       |
| answers               | array  | Array of all answers                                                                 | No       |                    |
| answers.*.question_id | int    | This is the id of the question                                                       | No       | 1,2,3 .. and so on |
| answers.*.answer_id   | int    | This is the id of the answer, term_id and topic_id are not used when this is present | No       | 1,2,3 .. and so on |
| answers.*.term_id     | int    | This is the id of the term, answer_id is not used when this is present               | No       | 1,2,3 .. and so on |
| answers.*.topic_id    | int    | This is the id of the topic, answer_id is not used when this is present              | No       | 1,2,3 .. and so on |

## Response

The response will be a JSON object with a message indicating the result.

Example request body:

```json
{
  "quiz_id": 1,
  "client_id": 1,
  "date": "2023-07-09",
  "answers": [
    {
      "question_id": 1,
      "answer_id": 2
    },
    {
      "question_id": 2,
      "answer_id": 4
    },
    {
      "question_id": 2,
      "answer_id": 5
    },
    {
      "question_id": 2,
      "answer_id": 6
    },
    {
      "question_id": 3,
      "term_id": 1,
      "topic_id": 1
    },
    {
      "question_id": 3,
      "term_id": 2,
      "topic_id": 2
    },
    {
      "question_id": 3,
      "term_id": 3,
      "topic_id": 2
    }
  ]
}
```

Successful response:

```json
{
  "message": "Successfully created a quiz for a client."
}
```
Failed responses:

```json
{
  "message": "Some parameters are missing, please try again."
}
```
```json
{
  "message": "Something went wrong whilst creating your submission, please try again."
}
```
