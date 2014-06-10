#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include "pifacedigital.h"

int main( int argc, char *argv[] )
{
	int nbPas;
	nbPas = atoi(argv[1]);
	int hw_addr = 0;
	pifacedigital_open(hw_addr);
	pifacedigital_enable_interrupts();
	pifacedigital_write_reg(0xFF, OUTPUT, hw_addr);

		
	pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
	usleep(100000);
	int i = 0;
	if (nbPas > 0)
	{
		for (i; i < nbPas; i++)
		{
			pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
			usleep(20000);
		}
	}
	else
	{
		nbPas = abs(nbPas);
		for (i; i < nbPas; i++)
		{
			pifacedigital_write_reg(0x90, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x30, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
			usleep(20000);
			pifacedigital_write_reg(0xC0, OUTPUT, hw_addr);
			usleep(20000);
		}
	}
	
	pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);
	return 0;
}