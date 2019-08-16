class Quiz {

    constructor() {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.title = '';

        /** @type {Number} */
        this.questionCount = 0;
    }

    static fromArray(rawData) {
        let quiz = new Quiz();

        quiz.id = rawData.id;
        quiz.title = rawData.title;
        quiz.questionCount = rawData.questionCount;

        return quiz;
    }
}

class Question {

    constructor() {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.text = '';

        /** @type {Array<Answer>} */
        this.answers = [];
    }

    static fromArray(rawData) {
        let question = new Question();

        question.id = rawData.id;
        question.text = rawData.text;

        // Pārtaisa answers par answer objektu.
        question.answers = rawData.answers.map((answerDatum) => {
            return Answer.fromArray(answerDatum);
        });

        return question;
    }
}

class Answer {

    constructor() {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.text = '';
    }

    static fromArray(rawData) {
        let answer = new Answer();

        answer.id = rawData.id;
        answer.text = rawData.text;

        return answer;
    }
}

class Result {

    constructor() {
        /** @type {?int} */
        this.correctAnswerCount = 0;
        // this.correctQuestionList = [];
        // this.incorrectQuestionList = [];
        this.answeredQuestionList = [];
    }

    static fromArray(rawData) {
        let result = new Result();

        result.correctAnswerCount = rawData.correctAnswerCount;
        // result.correctQuestionList = rawData.correctQuestionList;
        // result.incorrectQuestionList = rawData.incorrectQuestionList;
        result.answeredQuestionList = rawData.answeredQuestionList;

        return result;
    }
}

class Attempt {

    constructor() {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.quizTakenAt = '';

        /** @type {?int} */
        this.userId = null;

        /** @type {?int} */
        this.quizId = null;
    }

    static fromArray(rawData) {
        let attempt = new Attempt();

        attempt.id = rawData.id;
        attempt.quizTakenAt = rawData.quizTakenAt;
        attempt.userId = rawData.userId;
        attempt.quizId = rawData.quizId;

        return attempt;
    }
}

export {Quiz, Question, Answer, Result, Attempt}