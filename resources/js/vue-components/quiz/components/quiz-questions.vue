<template>
    <div class="container" style="height:70vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12">
                <div class="card bg-secondary">
                    <div class="card-body">

                        <div v-if="error.length" class="alert alert-danger">
                            {{ error }}
                        </div>

                        <p>Question {{currentQuestionNumber}} out of {{currentQuiz.questionCount}}</p>
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            :aria-valuemax="currentQuiz.questionCount" :style="{ width: getProgressPercentage() + '%' }"></div>
                        </div>

                        <div class="pl-1">
                            <h2 class="pb-1">{{ currentQuestionNumber}}. {{ currentQuestion.text }}</h2>
                            <p>Please select the correct answer below to continue.</p>
                        </div>

                        <div class="d-flex align-content-start flex-wrap mb-3">
                            <template v-for="answer in currentQuestion.answers">
                                <button @click="selectAnswer(answer)"
                                        :class="getAnswerButtonClass(answer)"
                                        class="btn flex-fill m-1">{{ answer.text }}
                                </button>
                            </template>
                        </div>

                        <div>
                            <button class="btn btn-primary m-1" @click="getNextQuestion()" :disabled="isButtonDisabled">
                                Next Question  <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import {Answer, Result, Question} from "../models/quiz.models";

    export default {
        props: {
            /** @type {Question} */
            currentQuestion: {
                required: true,
            },

            /** @type {Result} */
            result: {
                required: true,
            },

            /**
             * @type {Quiz}
             */
            currentQuiz: {
                required: true,
            },
        },

        data() {
            return {
                /** @type {?Answer} */
                selectedAnswer: null,
                loading: false,
                error: '',
                currentQuestionNumber: 1,
            }
        },

        methods: {
            selectAnswer(answer) {
                this.selectedAnswer = answer;
            },

            getAnswerButtonClass(answer) {
                return {
                    'btn-outline-primary': answer !== this.selectedAnswer,
                    'btn-primary': answer === this.selectedAnswer,
                }
            },

            getProgressPercentage() {
               return ((this.currentQuestionNumber - 1) / this.currentQuiz.questionCount) * 100;
            },

            getNextQuestion() {
                if (this.isButtonDisabled) {
                    return;
                }

                let data = new FormData;
                data.append('answerId', this.selectedAnswer.id);

                this.loading = true;

                axios.post('/quiz/next-question', data)
                    .then((response) => {

                        if (response.data.error) {
                            this.error = response.data.error;
                            return;
                        }

                        if (response.data.resultData) {
                            this.onResultsReceived(response.data.resultData);

                            this.currentQuestionNumber = 0;

                            return;
                        }

                        this.selectedAnswer = null;

                        let nextQuestion = Question.fromArray(response.data.questionData);

                        this.currentQuestion.id = nextQuestion.id;
                        this.currentQuestion.text = nextQuestion.text;
                        this.currentQuestion.answers = nextQuestion.answers;

                        this.currentQuestionNumber++;

                    })
                    .finally(() => {
                        this.loading = false;
                })
            },

            onResultsReceived(resultData) {
                let result = Result.fromArray(resultData);

                this.$emit('results-received', result);
            }
        },

        computed: {
            isButtonDisabled() {
                return !this.selectedAnswer || this.loading;
            }
        },
    }
</script>