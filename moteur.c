#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include "pifacedigital.h"

int Coord(int Chgt);
int Deplacement(int Bouge);
int Depart();

int main( int argc, char *argv[] )
{
	int nbPas, mode, verif;
	mode = atoi(argv[1]);
	int hw_addr = 0;
	pifacedigital_open(hw_addr);
	pifacedigital_enable_interrupts();
	pifacedigital_write_reg(0xF0, OUTPUT, hw_addr);

	if(mode == 1)
	{
		nbPas = atoi(argv[2]);
		verif = Coord(7*nbPas);

		if(verif == 0)
		{
			Deplacement(nbPas);
		}
	}
	else if(mode == 2)
	{
		char Commande[50];
		int mvt,Correction;
		while(1)
		{
			//system("CAPTURE")
			fscanf(Commande,"python traitement.py %s", argv[2]);
			mvt = system(Commande);
			if (mvt < 330 || mvt > 310)
			{
				system("./scripts/test")
				Depart();
				return 0;
			}
			else
			{
				Correction = mvt - 320;
				Correction = Correction / 66;
				verif = Coord(7*Correction);

				if (verif == 0)
				{
					Deplacement(Correction);
				}
			}
		}
	}
	return 0;
}

int Coord(int Chgt)
{
	FILE* fichier = NULL;
	char chaine[5] = "";
	int NCoord = 0; 
	fichier = fopen("Coordonnees.txt", "r+");

	if (fichier == NULL)
    {
    	printf("Impossible d'ouvrir le fichier texte");
    }

    fgets(chaine, 3, fichier);
    fclose(fichier);

    NCoord = atoi(chaine);
    NCoord = NCoord + Chgt;

    if(NCoord < 0 || NCoord > 180)
    {
    	return -1;
    }
    else
    {
    	fichier = fopen("Coordonnees.txt", "w+");
	    fprintf(fichier, "%d",NCoord);
	    fclose(fichier);
		return 0;
    }
}

int Deplacement(int Bouge)
{
	pifacedigital_write_reg(0x60, OUTPUT, hw_addr);
	usleep(100000);
	int i = 0;

	if (Bouge > 0)
	{
		for (i; i < Bouge; i++)
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
		Bouge = abs(Bouge);
		for (i; i < Bouge; i++)
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
}

int Depart()
{
	FILE* fichier = NULL;
	char chaine[5] = "";
	int NCoord = 0; 
	int Deplct = 0;
	fichier = fopen("Coordonnees.txt", "r+");

	if (fichier == NULL)
    {
    	printf("Impossible d'ouvrir le fichier texte");
    }

    fgets(chaine, 3, fichier);
    fclose(fichier);

    NCoord = atoi(chaine);

    while(NCoord < 90)
    {
    	NCoord++;
    	Deplct++;
    }
    while(NCoord > 90)
    {
    	NCoord--;
    	Deplct--;
    }

    Deplct = Deplct / 7;
    Deplacement(Deplct);

	return 0;
}