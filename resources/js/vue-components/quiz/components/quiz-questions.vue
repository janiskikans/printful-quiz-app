<template>
    <div class="container" style="height:70vh;">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="pl-1">
                            <h2 class="pb-1">{{ currentQuestion.text }}</h2>
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
    import {Answer} from "../models/quiz.models";

    export default {
        props: {
            /** @type {Question} */
            currentQuestion: {
                required: true,
            },
        },

        data() {
            return {
                /** @type {?Answer} */
                selectedAnswer: null,
                loading: false,
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

            getNextQuestion() {
                if (this.isButtonDisabled) {
                    return;
                }

                let data = new FormData;
                data.append('answerId', this.selectedAnswer.id);

                this.loading = true;

                axios.post('/quiz/next-question', data)
                    .then((response) => {

                    })
                    .finally(() => {
                        this.loading = false;
                })
            },
        },

        computed: {
            isButtonDisabled() {
                return !this.selectedAnswer || this.loading;
            }
        },
    }
</script>