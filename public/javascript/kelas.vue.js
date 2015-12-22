$(document).ready(function () {
    new Vue({
        el: '#kelas-app',
        data: {
            chapters: [
                {
                    id: 1,
                    name: 'Belajar Dengan Pensil',
                    description: 'Nantinya akan diajari dengan pensil',
                    quiz: [
                        {
                            id: 0,
                            
                        }
                    ]
                },
                {
                    id: 2,
                    name: 'Belajar Dengan Bolpoin',
                    description: 'Jangan lupa bawa bolpoin'
                }
            ]
        },
        methods: {
            addChapter: function () {
                this.chapters.push({
                    id: 0,
                    name: '',
                    description: ''
                })
            }
        }
    })
})