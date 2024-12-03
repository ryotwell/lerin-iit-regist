import { motion } from 'framer-motion'
import { ChevronRight } from 'lucide-react'

import { cn } from '../lib/utils'

import Countdown from '@/components/count-down'
import AnimatedGradientText from '../components/ui/animated-gradient-text'
import { HeroHighlight, Highlight } from '../components/ui/hero-highlight'
import HyperText from '../components/ui/hyper-text'
import { RainbowButton } from '../components/ui/rainbow-button'

export function HeroSection() {
    return (
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
                <AnimatedGradientText className="mb-6">
                    🚀 <hr className="mx-2 h-4 w-px shrink-0 bg-gray-300" />{" "}
                    <span
                    className={cn(
                        `inline animate-gradient bg-gradient-to-r from-[#ffaa40] via-[#9c40ff] to-[#ffaa40] bg-[length:var(--bg-size)_100%] bg-clip-text text-transparent`,
                    )}
                    >
                    At Universitas Hamzanwadi
                    </span>
                    <ChevronRight className="ml-1 size-3 transition-transform duration-300 ease-in-out group-hover:translate-x-0.5" />
                </AnimatedGradientText>
                UNHAZ x LERIN presents the
                <br />
                <Highlight className="text-black dark:text-white">
                    Robotic Competition
                </Highlight>.
                <br />
                {/* Join us and showcase your innovation! */}
                Show your team's skill and innovation!
            </motion.h1>
            <div className="flex justify-center mt-8">
                <RainbowButton href="#categories" data-aos="fade-up" data-aos-delay="500">
                    <HyperText
                        className="font-bold"
                        text="Daftar Sekarang"
                    />
                </RainbowButton>
            </div>
            <div className="flex justify-center mt-8" data-aos="fade-up" data-aos-delay="600">
                <Countdown />
            </div>
        </HeroHighlight>
    );
}