import WhatsappIcon from "./icons/whatsapp";
import { ModeToggle } from "./mode-toggle";
import { Button } from "./ui/button";

function FloatingShortcuts() {
    return (
        <ul className="block md:hidden fixed bottom-4 right-4 z-50">
            <li>
                <Button variant={'ghost'} size="icon" asChild>
                    <a href="https://wa.me/6285737074723" target="_blank" rel="noopener noreferrer">
                        <WhatsappIcon />
                    </a>
                </Button>
            </li>
            <li>
                <ModeToggle />
            </li>
        </ul>
    );
}

export default FloatingShortcuts;