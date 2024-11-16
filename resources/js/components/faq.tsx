import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion"
import * as React from "react"

type FaqQuestionType = {
    title: string
    answer: string
}

export function Faq() {
    const [questions, setQuestions] = React.useState<FaqQuestionType[]>(faqQuestions)

    return (
        <Accordion type="single" collapsible className="w-full mt-6">
            {questions.map((question, index) => (
                <AccordionItem key={index} value={`item-${index + 1}`}>
                    <AccordionTrigger>{question.title}</AccordionTrigger>
                    <AccordionContent>{question.answer}</AccordionContent>
                </AccordionItem>
            ))}
        </Accordion>
    )
}
