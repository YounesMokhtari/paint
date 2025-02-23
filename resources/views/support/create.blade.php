<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">ایجاد تیکت جدید</h2>

                    <form action="{{ route('tickets.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="subject" value="موضوع" />
                            <x-text-input id="subject" name="subject" type="text"
                                         class="block w-full mt-1" required />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="department" value="دپارتمان" />
                            <select id="department" name="department"
                                    class="block w-full mt-1 rounded-md border-gray-300">
                                <option value="technical">پشتیبانی فنی</option>
                                <option value="educational">مشاوره آموزشی</option>
                                <option value="financial">امور مالی</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="priority" value="اولویت" />
                            <select id="priority" name="priority"
                                    class="block w-full mt-1 rounded-md border-gray-300">
                                <option value="low">کم</option>
                                <option value="medium">متوسط</option>
                                <option value="high">زیاد</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="message" value="پیام" />
                            <textarea id="message" name="message" rows="6"
                                      class="block w-full mt-1 rounded-md border-gray-300"
                                      required></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex justify-end gap-4">
                            <x-secondary-button type="button" onclick="window.history.back()">
                                انصراف
                            </x-secondary-button>
                            <x-primary-button>
                                ثبت تیکت
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
