TITLE lab 3.1c Program 2
; Author: Lam Yoke Yu& Tan Yi Ya
; Date: 27 June 2024
include Irvine32.inc

.data
	arrayMsg BYTE "Calculate SUM (unsign INT) index (Odd or Even) in array Hello[6] : ", 0
	inputPrompt BYTE "Integer Input : ", 0
	resultStr BYTE "Result Sum Hello[index]: ", 0
	sumEvenStr BYTE "Sum Hello[even] index location : ", 0
	sumOddStr BYTE "Sum Hello[ood] index location : ", 0
	errorPrompt BYTE "Error: Please enter a valid integer.", 0
	hello DWORD 6 DUP(?)
	totalEven DWORD 0
	totalOdd DWORD 0

.code
main proc
	mov EDX, OFFSET arrayMsg
	call WriteString
	call crlf
	call crlf

	mov ECX, 6
	mov EBX, 0
	jmp INPUT

	INPUTERROR :
		mov EDX, OFFSET errorPrompt
		call WriteString
		call crlf

	INPUT:
		mov EDX, OFFSET inputPrompt
		call WriteString
		call ReadDec
		jc INPUTERROR
		cmp EAX, 0
		je INPUTERROR
		mov hello[EBX], EAX
		add EBX, 4
		loop INPUT

	call crlf
	mov ECX, 3
	mov EBX, 0

	ADDITION:
		mov EAX, hello[EBX]
		add totalEven, EAX
		add EBX, 4
		mov EAX, hello[EBX]
		add	totalOdd, EAX
		add EBX, 4
		loop ADDITION

	; Display Result
	mov EDX, OFFSET resultStr
	call WriteString
	call crlf
	call crlf

	mov EDX, OFFSET sumEvenStr
	call WriteString
	mov EAX, totalEven
	call WriteDec
	call crlf

	mov EDX, OFFSET sumOddStr
	call WriteString
	mov EAX, totalOdd
	call WriteDec
	call crlf

exit
main ENDP
END main
