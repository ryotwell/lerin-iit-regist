import AOS from 'aos'
import 'aos/dist/aos.css'

import * as React from 'react'
import ReactDOM from 'react-dom/client'

import { CategoryAppleCardsCarousel } from './comps/category'
import { HeroSection } from './comps/hero'

import { FooterSection } from '@/components/footer'
import { ModeToggle } from '@/components/mode-toggle'
import { FaqSection } from './components/faq'

import ApplicationLogo from './components/application-logo'
import { Button } from './components/ui/button'
import { Spotlight } from './components/ui/spotlight'

import FloatingShortcuts from './components/FloatingShortcuts'

const App: React.FC = () => {
    const [spotlightVisible, setSpotlightVisible] = React.useState(false)
    const [theme, setTheme] = React.useState('light')

    React.useEffect(() => {
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
            setTheme('dark')
        } else {
            document.documentElement.classList.remove('dark')
            setTheme('light')
        }
    }, [])

    React.useEffect(() => {
        AOS.init({
            duration: 500,
            once: true,
        })
    }, [])

    React.useEffect(() => {
        const timer = setTimeout(() => {
            setSpotlightVisible(true)
        }, 500)

        return () => clearTimeout(timer)
    }, [])

    return (
        <>
            <Spotlight
                className={`-top-40 left-0 md:left-60 md:-top-20 ${spotlightVisible ? 'block' : 'hidden'}`}
                fill={theme === 'dark' ? 'white' : '#9333ea'}
            />
            <div className="content absolute top-0 left-0 z-10 py-6 w-full flex justify-between items-center">
                <div data-aos="fade-right">
                    <ApplicationLogo />
                </div>
                <div className="flex items-center">
                    <div className="hidden md:block">
                        <ModeToggle data-aos="fade-down" />
                    </div>
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

            <FloatingShortcuts/>

            <FooterSection />
        </>
    )
}

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(<App />)
