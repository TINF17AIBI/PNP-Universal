using System;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Metadata;

namespace PnP_Universal.Models
{
    public partial class PnPContext : DbContext
    {
        public virtual DbSet<Adventures> Adventures { get; set; }
        public virtual DbSet<AttributeOwnership> AttributeOwnership { get; set; }
        public virtual DbSet<Attributes> Attributes { get; set; }
        public virtual DbSet<Heroes> Heroes { get; set; }
        public virtual DbSet<ItemOwnership> ItemOwnership { get; set; }
        public virtual DbSet<Items> Items { get; set; }
        public virtual DbSet<Templates> Templates { get; set; }
        public virtual DbSet<Users> Users { get; set; }

        public PnPContext(DbContextOptions<PnPContext> options) : base(options)
        { }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Adventures>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Adventures)
                    .HasForeignKey<Adventures>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Adventure__Templ__29572725");

                entity.HasOne(d => d.Id1)
                    .WithOne(p => p.Adventures)
                    .HasForeignKey<Adventures>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Adventure__Gamem__286302EC");
            });

            modelBuilder.Entity<AttributeOwnership>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.AttributeOwnership)
                    .HasForeignKey<AttributeOwnership>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Attribute__Attri__3B75D760");

                entity.HasOne(d => d.Id1)
                    .WithOne(p => p.AttributeOwnership)
                    .HasForeignKey<AttributeOwnership>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__AttributeO__Hero__3A81B327");
            });

            modelBuilder.Entity<Attributes>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Attributes)
                    .HasForeignKey<Attributes>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Attribute__Templ__30F848ED");
            });

            modelBuilder.Entity<Heroes>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Stats).IsRequired();

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Heroes)
                    .HasForeignKey<Heroes>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Heroes__Adventur__2E1BDC42");

                entity.HasOne(d => d.Id1)
                    .WithOne(p => p.Heroes)
                    .HasForeignKey<Heroes>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Heroes__Template__2D27B809");

                entity.HasOne(d => d.Id2)
                    .WithOne(p => p.Heroes)
                    .HasForeignKey<Heroes>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Heroes__Owner__2C3393D0");
            });

            modelBuilder.Entity<ItemOwnership>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.ItemId).HasColumnName("ItemID");

                entity.Property(e => e.OwnerId).HasColumnName("OwnerID");

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.ItemOwnership)
                    .HasForeignKey<ItemOwnership>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__ItemOwner__Owner__36B12243");

                entity.HasOne(d => d.Id1)
                    .WithOne(p => p.ItemOwnership)
                    .HasForeignKey<ItemOwnership>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__ItemOwner__ItemI__37A5467C");
            });

            modelBuilder.Entity<Items>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Type)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Items)
                    .HasForeignKey<Items>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Items__Adventure__33D4B598");
            });

            modelBuilder.Entity<Templates>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Description)
                    .IsRequired()
                    .HasColumnType("text");

                entity.Property(e => e.Name)
                    .IsRequired()
                    .HasMaxLength(32);

                entity.HasOne(d => d.IdNavigation)
                    .WithOne(p => p.Templates)
                    .HasForeignKey<Templates>(d => d.Id)
                    .OnDelete(DeleteBehavior.ClientSetNull)
                    .HasConstraintName("FK__Templates__Creat__25869641");
            });

            modelBuilder.Entity<Users>(entity =>
            {
                entity.Property(e => e.Id)
                    .HasColumnName("ID")
                    .ValueGeneratedNever();

                entity.Property(e => e.Email)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Password)
                    .IsRequired()
                    .HasMaxLength(50);

                entity.Property(e => e.Username)
                    .IsRequired()
                    .HasMaxLength(50);
            });
        }
    }
}
