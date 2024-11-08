import Footer from '@/components/footer';
import { ModeToggle } from '@/components/mode-toggle';
import AOS from "aos";
import "aos/dist/aos.css";
import { motion } from 'framer-motion';
import * as React from 'react';
import ReactDOM from 'react-dom/client';
import { Button } from './components/ui/button';
import { HeroHighlight, Highlight } from './components/ui/hero-highlight';
import { RainbowButton } from './components/ui/rainbow-button';
import { CategoryAppleCardsCarousel } from './comps/category';

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
          duration: 500, // Durasi animasi dalam milidetik
          once: true,     // Apakah animasi hanya terjadi sekali saat scroll
        });
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
                <div className="flex items-center" data-aos="fade-left">
                    <ModeToggle />
                    <Button className="ml-2" asChild>
                        <a href="/panel/login">
                            Login
                        </a>
                    </Button>
                </div>
            </div>

            <HeroHighlight
                className=""
                containerClassName="min-h-screen bg-gradient-to-t from-slate-300 dark:from-slate-900"
            >
                <motion.h1
                    initial={{
                        opacity: 0,
                        y: 20,
                    }}
                    animate={{
                        opacity: 1,
                        y: [20, -5, 0],
                    }}
                    transition={{
                        duration: 0.5,
                        ease: [0.4, 0.0, 0.2, 1],
                    }}
                    className="text-3xl px-4 md:text-4xl lg:text-5xl font-bold text-neutral-700 dark:text-white max-w-4xl leading-relaxed lg:leading-snug text-center mx-auto "
                >
                    Lerin is taking on the
                    <br />
                    <Highlight className="text-black dark:text-white">
                        IIT Challenge Program
                    </Highlight>.
                    <br />
                    Join us on a journey to make a difference.
                </motion.h1>
                <div className="flex justify-center mt-8">
                    <RainbowButton href="#categories" data-aos="fade-up" data-aos-delay="500">Daftar Sekarang</RainbowButton>
                </div>
            </HeroHighlight>

            <CategoryAppleCardsCarousel />

            <Footer />
        </>
    );
};

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(<App />);
