import { Moon, Sun } from 'lucide-react'
import { Button } from './ui/button'

interface ModeToggleProps {
    'data-aos'?: string
}

export function ModeToggle({ 'data-aos': dataAos }: ModeToggleProps) {
    const handleTheme = () => {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark')
            localStorage.theme = 'light'
        } else {
            document.documentElement.classList.add('dark')
            localStorage.theme = 'dark'
        }
    }

    return (
        <Button variant="ghost" size="icon" onClick={handleTheme} data-aos={dataAos}>
            <Sun className="h-[1.2rem] w-[1.2rem] rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0" />
            <Moon className="absolute h-[1.2rem] w-[1.2rem] rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100" />
            <span className="sr-only">Toggle theme</span>
        </Button>
    )
}