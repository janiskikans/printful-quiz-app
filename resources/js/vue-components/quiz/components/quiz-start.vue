<template>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-12">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div v-if="error.length" class="alert alert-danger">
                            {{ error }}
                        </div>

                        <h1 class="pb-1">Quiz Select</h1>
                        <p>Please select a Quiz from the list below to start. Currently there are <strong>{{ quizzes.length }}</strong> quizzes available.</p>

                        <select class="custom-select" v-model="selectedQuizId">
                            <option value="-1">Please select a Quiz..</option>

                            <option :value="quiz.id" v-for="(quiz, index) in quizzes">
                                {{ quiz.title }} (~{{ calculateEstimateCompletionTime(index) }}
                                <span v-if="calculateEstimateCompletionTime(index) > 1">minutes</span>
                                <span v-else>minute</span>)
                            </option>
                        </select>

                        <div class="mt-3">
                            <button @click="startQuiz" :disabled="!canStartQuiz" class="btn btn-primary mr-1">Start Quiz
                            </button>
                            <a href="/quiz-create" class="btn btn-outline-primary">Create a Quiz</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import axios from 'axios';
    import {Question} from '../models/quiz.models.js';

    export default {
        // Norada komponentes vertibas.
        props: {
            name: {
                required: true,
            },
            quizzes: {
                default: [],
                required: true,
            }
        },

        data() {
            return {
                selectedQuizId: '-1',
                error: '',
                loading: false,
            }
        },

        methods: {
            startQuiz() {
                this.error = '';

                if (!this.canStartQuiz) {
                    return;
                }

                let data = new FormData;
                data.append('quizId', this.selectedQuizId);

                this.loading = true;

                axios.post('/quiz/start', data)
                    .then((response) => {
                        if (response.data.error) {
                            this.error = response.data.error;
                            return;
                        }

                        let question = Question.fromArray(response.data.questionData);

                        this.$emit('quiz-started', {
                            'quizId': this.selectedQuizId,
                            'firstQuestion': question,
                        });

                    }).finally(() => {
                        this.loading = false;
                });

                /*axios.post('/quiz/start', {
                    quizId: this.selectedQuizId,
                }).then((response) => {
                    console.log(response);
                });*/
            },

            calculateEstimateCompletionTime($quizIndex) {
                return this.quizzes[$quizIndex].questionCount * 0.5;
            },
        },

        computed: {
            canStartQuiz() {
                return this.selectedQuizId > 0 && !!this.selectedQuizId && !this.loading;

                // ! (negācijas operators). Atgriež boolean vai vērtība ir iestatīta. !! - pretējais.
                // return !!this.selectedQuizId;
            },
        }
    }
</script>