$(document).ready(function () {
    var STORAGE_KEY = 'vue-kelas-app';

    var store = {
        fetch: function () {
            return JSON.parse(localStorage.getItem(STORAGE_KEY))
        },
        save: function (course) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(course));
            console.log(JSON.stringify(course))
        },
        destroy: function () {
            localStorage.removeItem(STORAGE_KEY);
        }
    }

    function objChapter() {
        this.name = '';
        this.description = '';
        this.quiz = [];
    }

    function objChapterQuiz() {
        this.question = '';
        this.answer = {
            a: '',
            b: '',
            c: '',
            d: ''
        };
        this.correct = '';
    }

    function objCourse() {
        this.name = '';
        this.category = 0;
        this.chapters = [];
        this.exams = [];
    }

    window.app = new Vue({
        el: '#kelas-app',
        data: {
            course: new objCourse,
            input: {
                chapterQuiz: new objChapterQuiz
            }
        },
        watch: {
            course: {
                deep: true,
                handler: function (val, oldVal) {
                    store.save(val);
                }
            }
        },
        methods: {
            initData: function (storage) {
                if (!storage) {
                    storage = store.fetch();
                }

                $.extend(this.course, storage);
            },
            addChapter: function () {
                this.course.chapters.push(new objChapter);
            },
            addChapterQuiz: function (chapterIndex) {
                this.input.chapterQuiz.chapterIndex = chapterIndex;
            },
            saveChapterQuiz: function () {
                var index = this.input.chapterQuiz.chapterIndex;
                var chapter = this.course.chapters[index];

                chapter.quiz.push(this.input.chapterQuiz);

                this.resetInput('chapterQuiz', new objChapterQuiz);
            },
            resetInput: function (name, data) {
                if (name) {
                    if (data)
                        this.input[name] = data;
                    else
                        this.input[name] = [];
                }
            },
            reset: function () {
                store.destroy();
                this.course = new objCourse;
            }
        }
    })

    app.initData();
})