<template>
    <div class="table-responsive bg-gray-50 p-5">
        <div class="bg-white rounded-lg p-5">
            <table class="table-list">
                <thead>
                <tr>
                    <th>
                    </th>
                    <th style="width:5px !important; padding: 0"></th>
                    <th>Наименование</th>
                    <th class="flex justify-center">Кол-во</th>
                    <th>Источник</th>
                    <th>Лазер</th>
                    <th>Сварка</th>
                    <th>Сборка</th>
                    <th>Электр</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <template v-for="(part, i) in parts" :key="part.id">
                        <tr class="bgc-gray rounded-lg">
                            <td class="bg-white" style="padding-right: 10px">
                                <div class="flex flex-col items-end">
                                    <UpDownArrow @click.prevent="() => i !== 0 ? move(part.id, true) : {}" 
                                                :isUp="true" 
                                                :isDisabled="i === 0" />
                                    <UpDownArrow @click.prevent="() => i !== parts.length - 1 ? move(part.id, false) : {}" 
                                                :isUp="false" 
                                                :isDisabled="i === parts.length - 1" />
                                </div>
                            </td>
                            <td colspan="2">
                                {{ part.title }} 
                                <OpenCloseArrow v-if="part.parts" 
                                                @click.prevent="toggleOpened(part.id)" 
                                                :isOpened="opened.includes(part.id)" />
                            </td>
                            <td class="flex justify-center"><span :class="part.parts ? 'qty-border border border-1 border-slate-300 rounded' : ''">{{ part.qty }}</span></td>
                            <td>{{ part.source }}</td>
                            <td>{{ part.laser }}</td>
                            <td>{{ part.welding }}</td>
                            <td>{{ part.assembling }}</td>
                            <td>{{ part.electro }}</td>
                            <td>
                                <button type="button" class="bg-indigo-600 hover:bg-indigo-700 text-white hover:text-white p-1 rounded mr-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="fill-current w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5zm8.25-3.75a.75.75 0 01.75.75v2.25h2.25a.75.75 0 010 1.5h-2.25v2.25a.75.75 0 01-1.5 0v-2.25H7.5a.75.75 0 010-1.5h2.25V7.5a.75.75 0 01.75-.75z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <button :disabled="!part.canDelete" @click.prevent="remove(part.id)" type="button" class="bg-rose-600 hover:bg-rose-700 disabled:bg-rose-400 text-white hover:text-white p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="fill-current w-4 h-4">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <template v-if="part.parts && opened.includes(part.id)">
                            <tr v-for="item in part.parts" class="">
                                <td></td>
                                <td style="width:5px !important; padding: 0"></td>
                                <td class="border border-spacing-1 border-r-0 rounded-lg pl-2">{{ item.title }}</td>
                                <td class="border border-spacing-1 border-r-0 border-l-0">{{ item.qty }}</td>
                                <td class="border border-spacing-1 border-r-0 border-l-0">{{ item.source }}</td>
                                <td class="border border-spacing-1 border-r-0 border-l-0">{{ item.laser }}</td>
                                <td class="border border-spacing-1 border-r-0 border-l-0">{{ item.welding }}</td>
                                <td class="border border-spacing-1 border-r-0 border-l-0">{{ item.assembling }}</td>
                                <td class="border border-spacing-1 border-r-0 border-l-0">{{ item.electro }}</td>
                                <td class="border border-spacing-1 border-l-0 rounded-lg"></td>
                            </tr>
                        </template>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import {ref, onMounted} from 'vue'
    import OpenCloseArrow from './UI/OpenCloseArrow.vue'
    import UpDownArrow from './UI/UpDownArrow.vue'

    export default {
        components: { OpenCloseArrow, UpDownArrow },

        setup() {
            const parts = ref(null)
            const opened = ref([])

            const fetchParts = () => {
                axios.get('/api/parts')
                    .then(res => {
                        // console.log(res.data)
                        parts.value = res.data
                    })
                    .catch(err => console.log(err.response?.data?.message))
            }

            const move = (id, up = true) => {
                axios.patch(`/api/parts/move/${id}`, {up})
                    .then(res => {
                        // console.log(res.data)
                        parts.value = res.data
                    })
                    .catch(err => console.log(err.response?.data?.message))
            }

            const remove = (id) => {
                axios.delete(`/api/parts/${id}`)
                    .then(res => {
                        // console.log(res.data)
                        parts.value = res.data
                    })
                    .catch(err => console.log(err.response?.data?.message))
            }

            const toggleOpened = (id) => {
                let index = opened.value.indexOf(id)
                if(index < 0)
                    opened.value.push(id)
                else
                    opened.value.splice(index, 1)
            }

            onMounted(() => {
                fetchParts()
            })

            return {
                parts,
                opened,
                toggleOpened,
                move,
                remove,
            }
        }
    }
</script>
<style scoped>
    td {
        font-size: 14px !important;
    }

    .qty-border {
        display: inline-block;
        text-align: center;
        height: 24px;
        line-height: 24px;
        min-width: 24px;
    }
</style>

