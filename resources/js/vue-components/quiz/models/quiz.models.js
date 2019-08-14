class Quiz {

    constructor() {
        /** @type {?int} */
        this.id = null;

        /** @type {string} */
        this.title = '';
    }

    static fromArray(rawData) {
        let quiz = new Quiz();

        quiz.id = rawData.id;
        quiz.title = rawData.title;

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

export {Quiz, Question, Answer}