import ApplicationLogo from "./application-logo";

export function FooterSection() {
    return (
        <footer className="bg-white shadow dark:bg-slate-950">
            <div className="content p-4 md:py-8">
                <div className="sm:flex sm:items-center sm:justify-between">
                    <a
                        href="#!"
                        className="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse"
                    >
                        <ApplicationLogo />
                    </a>
                    <ul className="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li>
                            <a
                                href="#!"
                                className="hover:underline me-4 md:me-6"
                            >
                                About
                            </a>
                        </li>
                        <li>
                            <a href={`https://wa.me/6285737074723`} target="_blank" className="hover:underline">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
                <hr className="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <span className="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    {`© 2024 Copyright. All Rights Reserved by LERIN NTB (Lembaga Edukasi Riset & Inovasi Nusa Tenggara Barat)`}
                </span>
            </div>
        </footer>
    )
}