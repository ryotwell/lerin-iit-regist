import AOS from 'aos'
import 'aos/dist/aos.css'

import * as React from 'react'
import ReactDOM from 'react-dom/client'

import { CategoryAppleCardsCarousel } from './comps/category'
import { HeroSection } from './comps/hero'

import { FooterSection } from '@/components/footer'
import { ModeToggle } from '@/components/mode-toggle'
import { FaqSection } from './components/faq'

import { Button } from './components/ui/button'

const App: React.FC = () => {

    React.useEffect(() => {
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    }, [])

    React.useEffect(() => {
        AOS.init({
            duration: 500,
            once: true,
        })
    }, [])

    return (
        <>
            <div className="content absolute top-0 left-0 z-10 py-6 w-full flex justify-between items-center">
                <img
                    className="w-28 rounded-md"
                    src="/lerin-black.png"
                    alt="Lerin NTB"
                    data-aos="fade-right"
                />
                <div className="flex items-center">
                    <ModeToggle data-aos="fade-down" />
                    <Button className="ml-2" asChild data-aos="fade-left">
                        <a href="/panel/login">
                            Login
                        </a>
                    </Button>
                </div>
            </div>

            <HeroSection />

            <CategoryAppleCardsCarousel />

            <FaqSection />

            <FooterSection />
        </>
    )
}

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(<App />)
