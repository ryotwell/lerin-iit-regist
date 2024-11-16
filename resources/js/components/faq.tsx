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

const faqQuestions: FaqQuestionType[] = [
    {
        title: 'Berapa jumlah orang dalam satu tim?',
        answer: 'Anggota 2 orang, dan 1 orang sebagai penanggung jawab tim, jadi total 3 orang, berlaku di semua kategori.',
    },
]

export function Faq() {
    const [questions, setQuestions] = React.useState<FaqQuestionType[]>(faqQuestions)

    return (
        <Accordion type="single" collapsible className="w-full mt-6">
            {questions.map((question, index) => (
                <AccordionItem key={index} value={`item-${index}`}>
                    <AccordionTrigger>{question.title}</AccordionTrigger>
                    <AccordionContent>{question.answer}</AccordionContent>
                </AccordionItem>
            ))}
        </Accordion>
    )
}